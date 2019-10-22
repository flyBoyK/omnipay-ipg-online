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
     * Get charge total
     * @return string
     */
    public function getChargeTotal()
    {
        return $this->getParameter('charge_total');
    }

    /**
     * Set charge total
     * @param string $chargeTotal
     */
    public function setChargeTotal($chargeTotal)
    {
        $this->setParameter('charge_total', $chargeTotal);
    }

    /**
     * Get datetime
     * @return string
     */
    public function getDatetime()
    {
        return $this->getParameter('datetime');
    }

    /**
     * Set datetime
     * @param string $datetime
     */
    public function setDatetime($datetime)
    {
        $this->setParameter('datetime', $datetime);
    }

    /**
     * Get response hash
     * @return string
     */
    public function getResponseHash()
    {
        return $this->getParameter('response_hash');
    }

    /**
     * Set response hash
     * @param string $responseHash
     */
    public function setResponseHash($responseHash)
    {
        $this->setParameter('response_hash', $responseHash);
    }

    /**
     * @inheritdoc
     * @throws
     */
    public function getData()
    {
        $this->validate(
            'store_id',
            'share_secret',
            'approval_code',
            'oid',
            'status',
            'ipg_transaction_id',
            'charge_total',
            'currency',
            'datetime',
            'response_hash'
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
