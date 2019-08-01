<?php

namespace Omnipay\IpgOnline\Message;

class PurchaseRequest extends AbstractRequest
{
    /**
     * Get call back url
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->getParameter('callback_url');
    }

    /**
     * Set callback url
     * @param string $callbackUrl
     */
    public function setCallBackUrl($callbackUrl)
    {
        $this->setParameter('callback_url', $callbackUrl);
    }

    /**
     * Get data
     *
     * @return array
     * @throws
     */
    public function getData()
    {
        // 检查数据是否齐全
        $this->validate(
            'store_id',
            'share_secret',
            'callback_url',
            'request_url',
            'request_test_url',
            'pay_info',
            'environment',
            'language',
            'currency',
            'timezone_name'
        );

        return [];
    }

    /**
     * Send data
     *
     * @param array $data
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
