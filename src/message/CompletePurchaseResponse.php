<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /* @var CompletePurchaseRequest $request */
    protected $request;

    /**
     * Create hash
     *
     * @param $hashAlgorithm
     * @return string
     */
    private function createHash($hashAlgorithm = 'sha256')
    {
        $stringToHash  = $this->request->getShareSecret();
        $stringToHash .= $this->request->getApprovalCode();
        $stringToHash .= $this->request->getChargeTotal();
        $stringToHash .= $this->request->getCurrency();
        $stringToHash .= $this->request->getDateTime();
        $stringToHash .= $this->request->getStoreId();

        $ascii = bin2hex($stringToHash);

        return hash(strtolower($hashAlgorithm), $ascii);
    }

    /**
     * @return bool
     */
    private function validateResponseHash()
    {
        return $this->request->getResponseHash() === $this->createHash();
    }

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return $this->validateResponseHash();
    }

    /**
     * 验证是否成功支付
     */
    public function isPaid()
    {
        if (! $this->isSuccessful()) {
            return false;
        }

        $approvalCode = $this->request->getApprovalCode();
        if (strpos($approvalCode, 'Y') === 0) {
            return true;
        }

        if (strpos($approvalCode, '?') === 0) {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->request->getStatus();
    }

    /**
     * @inheritdoc
     */
    public function getTransactionId()
    {
        return $this->request->getIpgTransactionID();
    }
}