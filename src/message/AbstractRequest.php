<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\AbstractRequest As CommonRequest;

abstract class AbstractRequest extends CommonRequest
{
    /**
     * 取得时区名称【Asia/Shanghai | Asia/Beijing ...】
     * @return string
     */
    public function getTimezoneName()
    {
        return $this->getParameter('timezone_name');
    }

    /**
     * 设置时区名称
     * @param string $timezone_name
     */
    public function setTimezoneName($timezone_name)
    {
        $this->setParameter('timezone_name', $timezone_name);
    }

    /**
     * 取得用戶語言
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * 设置用戶語言
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->setParameter('language', $language);
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

    /**
     * Set environment
     *
     * @param string $environment
     */
    public function setEnvironment($environment)
    {
        $this->parameters->set('environment', $environment);
    }

    /**
     * Get environment
     * @return string
     */
    public function getEnvironment()
    {
        return $this->parameters->get('environment');
    }

    /**
     * Set gateway url
     * @param array $url
     */
    public function setRequestUrl($url)
    {
        $this->parameters->set('request_url', $url);
    }

    /**
     * Get pay info
     * @return array
     */
    public function getRequestUrl()
    {
        return $this->parameters->get('request_url');
    }

    /**
     * 取得测试环境的网关Api
     * @return string
     */
    public function getRequestTestUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('request_test_url'));
    }

    /**
     * 设置测试环境的网关Api
     * @param $url
     */
    public function setRequestTestUrl($url)
    {
        $this->setParameter('request_test_url', $url);
    }

    /**
     * Get store id
     * @return string
     */
    public function getStoreId()
    {
        return $this->getParameter('store_id');
    }

    /**
     * Set store id
     * @param $store_id
     */
    public function setStoreId($store_id)
    {
        $this->setParameter('store_id', $store_id);
    }

    /**
     * Get user id
     * @return string
     */
    public function getUserId()
    {
        return $this->getParameter('user_id');
    }

    /**
     * Set user id
     * @param string $user_id
     */
    public function setUserId($user_id)
    {
        $this->setParameter('user_id', $user_id);
    }

    /**
     * Get user password
     * @return string
     */
    public function getUserPassword()
    {
        return $this->getParameter('user_password');
    }

    /**
     * Set user password
     * @param string $userPassword
     */
    public function setUserPassword($userPassword)
    {
        $this->setParameter('user_password', $userPassword);
    }

    /**
     * Get merchant name
     * @return string
     */
    public function getMerchantName()
    {
        return $this->getParameter('merchant_name');
    }

    /**
     * Set merchant name
     * @param string $merchantName
     */
    public function setMerchantName($merchantName)
    {
        $this->setParameter('merchant_name', $merchantName);
    }

    /**
     * Get shared secret
     * @return string
     */
    public function getSharedSecret()
    {
        return $this->getParameter('shared_secret');
    }

    /**
     * Set shared secret
     * @param string $sharedSecret
     */
    public function setSharedSecret($sharedSecret)
    {
        $this->setParameter('shared_secret', $sharedSecret);
    }
}
