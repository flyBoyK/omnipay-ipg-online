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
     * Get trust cert file path
     * @return string
     */
    public function getTrustCertFilePath()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('trust_cert_file_path'));
    }

    /**
     * Set trust cert file path
     * @param $trustCertFilePath
     */
    public function setTrustCertFilePath($trustCertFilePath)
    {
        $this->setParameter('trust_cert_file_path', $trustCertFilePath);
    }

    /**
     * Get client ssl certificate file path
     * @return string
     */
    public function getClientSslCertFilePath()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('client_ssl_cert_file_path'));
    }

    /**
     * Set client ssl certificate file path
     * @param $clientSslCertificateFilePath
     */
    public function setClientSslCertFilePath($clientSslCertificateFilePath)
    {
        $this->setParameter('client_ssl_cert_file_path', $clientSslCertificateFilePath);
    }

    /**
     * Get client ssl key file path
     * @return string
     */
    public function getClientSslKeyFilePath()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('client_ssl_key_file_path'));
    }

    /**
     * Set client ssl key file path
     * @param string $clientSslKeyFilePath
     */
    public function setClientSslKeyFilePath($clientSslKeyFilePath)
    {
        $this->setParameter('client_ssl_key_file_path', $clientSslKeyFilePath);
    }

    /**
     * Get client ssl key password
     * @return string
     */
    public function getClientSslKeyPassword()
    {
        return $this->getParameter('client_ssl_key_password');
    }

    /**
     * Set client ssl key password
     * @param $clientSslKeyPassword
     */
    public function setClientSslKeyPassword($clientSslKeyPassword)
    {
        $this->setParameter('client_ssl_key_password', $clientSslKeyPassword);
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
}