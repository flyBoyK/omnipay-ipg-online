<?php

namespace Omnipay\IpgOnline\Message;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Get approval code
     * @return string
     */
    public function getApprovalCode()
    {
        return $this->getParameter('approval_code');
    }

    /**
     * @param string $approvalCode
     */
    public function setApprovalCode($approvalCode)
    {
        $this->setParameter('approval_code', $approvalCode);
    }

    /**
     * Get Order id
     * @return string
     */
    public function getOid()
    {
        return $this->getParameter('oid');
    }

    /**
     * Set oid
     * @param string $oid
     */
    public function setOid($oid)
    {
        $this->setParameter('oid', $oid);
    }

    /**
     * Get Status
     * @return string
     */
    public function getStatus()
    {
        return $this->getParameter('status');
    }

    /**
     * Set status
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->setParameter('status', $status);
    }

    /**
     * Get ipg transaction id
     * @return string
     */
    public function getIpgTransactionID()
    {
        return $this->getParameter('ipg_transaction_id');
    }

    /**
     * Set ipg transaction id
     * @param string $ipgTransactionID
     */
    public function setIpgTransactionID($ipgTransactionID)
    {
        $this->setParameter('ipg_transaction_id', $ipgTransactionID);
    }

    /**
     * @inheritdoc
     * @throws
     */
    public function getData()
    {
        $this->validate(
            'approval_code',
            'oid',
            'status',
            'ipg_transaction_id'
        );

        return [];
    }

    /**
     * @inheritdoc
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}
