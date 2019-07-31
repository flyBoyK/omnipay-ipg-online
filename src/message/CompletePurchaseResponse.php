<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /* @var CompletePurchaseRequest $request */
    protected $request;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
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