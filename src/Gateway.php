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
     * Get Pay logo
     * @return string
     */
    public function getPayLogoFilePath()
    {
        return $this->getParameter('pay_logo_file_path');
    }

    /**
     * Set Pay logo
     * @param $payLogoFilePath
     */
    public function setPayLogoFilePath($payLogoFilePath)
    {
        $this->setParameter('pay_logo_file_path', $payLogoFilePath);
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
    public function setClientSslCertificateFilePath($clientSslCertificateFilePath)
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
     * Get purchase request url
     * @return string
     */
    public function getPurchaseRequestUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('purchase_request_url'));
    }

    /**
     * Set purchase request url
     * @param string $purchaseRequestUrl
     */
    public function setPurchaseRequestUrl($purchaseRequestUrl)
    {
        $this->setParameter('purchase_request_url', $purchaseRequestUrl);
    }

    /**
     * Get purchase request callback url
     * @return string
     */
    public function getPurchaseRequestCallbackUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('purchase_request_callback_url'));
    }

    /**
     * Set purchase request callback url
     * @param $purchaseRequestCallbackUrl
     */
    public function setPurchaseRequestCallbackUrl($purchaseRequestCallbackUrl)
    {
        $this->setParameter('purchase_request_callback_url', $purchaseRequestCallbackUrl);
    }

    /**
     * Get purchase request form url
     * @return string
     */
    public function getPurchaseRequestFormUrl()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('purchase_request_form_url'));
    }

    /**
     * Set purchase request form url
     * @param $purchaseRequestFormUrl
     */
    public function setPurchaseRequestFormUrl($purchaseRequestFormUrl)
    {
        $this->setParameter('purchase_request_form_url', $purchaseRequestFormUrl);
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
        return $this->createRequest('Omnipay\IpgOnline\Message\PurchaseRequest', $options);
    }

    /**
     * @inheritdoc
     */
    public function completePurchase(array $options = array())
    {
        // TODO: Implement completePurchase() method.
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