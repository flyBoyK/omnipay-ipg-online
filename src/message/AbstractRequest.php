<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\AbstractRequest As CommonRequest;

abstract class AbstractRequest extends CommonRequest
{
    /**
     * Set order info
     * @param array $order_info
     */
    public function setOrderInfo(array $order_info)
    {
        $this->parameters->set('order_info', $order_info);
    }

    /**
     * Get order info
     * @return array
     */
    public function getOrderInfo()
    {
        return $this->parameters->get('order_info');
    }

    /**
     * Set client request method
     * @param $request_method
     */
    public function setRequestMethod($request_method)
    {
        $this->parameters->set('request_method', $request_method);
    }

    /**
     * Get client request method
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->parameters->get('request_method');
    }

    /**
     * Set pay info
     * @param array $pay_info
     */
    public function setPayInfo(array $pay_info)
    {
        $this->parameters->set('pay_info', $pay_info);
    }

    /**
     * Get pay info
     * @return array
     */
    public function getPayInfo()
    {
        return $this->parameters->get('pay_info');
    }
}