<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * 取得回应的SOAP
     * @return string xml
     */
    public function getResponseSoap()
    {
        return $this->getParameter('response_soap');
    }

    /**
     * 设置回应的SOAP
     * @param string $responseSoap
     */
    public function setResponseSoap($responseSoap)
    {
        $this->setParameter('response_soap', $responseSoap);
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return [
            'success' => (bool) $this->getResponseSoap(),
            'message' => 'test message',
            'transaction_id' => 'test',
            'response_soap' => $this->getResponseSoap(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}
