<?php

namespace Omnipay\IpgOnline;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'IPG Online';
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
     * Get merchant name
     * @return string
     */
    public function getShareSecret()
    {
        return $this->getParameter('share_secret');
    }

    /**
     * Set shared secret
     *
     * @param string $sharedSecret
     */
    public function setShareSecret($sharedSecret)
    {
        $this->setParameter('share_secret', $sharedSecret);
    }

    /**
     * 取得支付环境 {测试OR生产}
     * @return string
     */
    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }

    /**
     * 设置支付环境
     * @param $environment
     */
    public function setEnvironment($environment)
    {
        $this->setParameter('environment', $environment);
    }

    /**
     * 取得测试环境的网关Url
     * @return string
     */
    public function getRequestTestUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('request_test_url'));
    }

    /**
     * 设置测试环境的网关Url
     * @param $url
     */
    public function setRequestTestUrl($url)
    {
        $this->setParameter('request_test_url', $url);
    }

    /**
     * 取得网关Api
     * @return string
     */
    public function getRequestUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('request_url'));
    }

    /**
     * 设置网关Api
     *
     * @param string $url
     */
    public function setRequestUrl($url)
    {
        $this->setParameter('request_url', $url);
    }

    /**
     * 取得支付回调Api
     * @return string
     */
    public function getPurchaseRequestCallbackUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('purchase_request_callback_url'));
    }

    /**
     * 设置支付回调Api
     * @param $purchaseRequestCallbackUrl
     */
    public function setPurchaseRequestCallbackUrl($purchaseRequestCallbackUrl)
    {
        $this->setParameter('purchase_request_callback_url', $purchaseRequestCallbackUrl);
    }

    /**
     * @inheritdoc
     */
    public function authorize(array $options = array())
    {
        // TODO: Implement authorize() method.
    }

    /**
     * @inheritdoc
     */
    public function completeAuthorize(array $options = array())
    {
        // TODO: Implement completeAuthorize() method.
    }

    /**
     * @inheritdoc
     */
    public function createCard(array $options = array())
    {
        // TODO: Implement createCard() method.
    }

    /**
     * @inheritdoc
     */
    public function updateCard(array $options = array())
    {
        // TODO: Implement updateCard() method.
    }

    /**
     * @inheritdoc
     */
    public function deleteCard(array $options = array())
    {
        // TODO: Implement deleteCard() method.
    }

    /**
     * @inheritdoc
     */
    public function void(array $options = array())
    {
        // TODO: Implement void() method.
    }

    /**
     * @inheritdoc
     */
    public function purchase(array $options = array())
    {
        return $this->createRequest('\Omnipay\IpgOnline\Message\PurchaseRequest', $options);
    }

    /**
     * @inheritdoc
     */
    public function completePurchase(array $options = array())
    {
        return $this->createRequest('\Omnipay\IpgOnline\Message\CompletePurchaseRequest', $options);
    }

    /**
     * @inheritdoc
     */
    public function refund(array $options = array())
    {
        // TODO: Implement refund() method.
    }

    /**
     * @inheritdoc
     */
    public function capture(array $options = array())
    {
        // TODO: Implement capture() method.
    }
}