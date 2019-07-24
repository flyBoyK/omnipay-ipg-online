<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\IpgOnline\Message\PurchaseResponse;

class PurchaseRequest extends AbstractRequest
{
    /**
     * Get call back url
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
     * Get company name
     */
    public function getCompanyName()
    {
        return $this->getParameter('company_name');
    }

    /**
     * Set company name
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->setParameter('company_name', $companyName);
    }

    /**
     * Get company logo
     */
    public function getCompanyLogo()
    {
        return $this->getParameter('company_logo');
    }

    /**
     * Set company logo
     *
     * @param string $companyLogo
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->setParameter('company_logo', $companyLogo);
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
            'callback_url',
            'company_name',
            'company_logo',
            'order_info'
        );

        $order_info = $this->getOrderInfo();

        // 返回数据
        return array(
            'callback_url'      => $this->getCallbackUrl(),
            'company_name'      => $this->getCompanyName(),
            'company_logo'      => $this->getCompanyLogo(),
            'order_id'          => $order_info['order_id'],
            'total_amount'      => $order_info['total_amount'],
            'pay_amount'        => $order_info['pay_amount'],
            'customer_name'     => $order_info['customer_name'],
            'customer_mobile'   => $order_info['customer_mobile'],
            'customer_address'  => $order_info['customer_address'],
        );
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
