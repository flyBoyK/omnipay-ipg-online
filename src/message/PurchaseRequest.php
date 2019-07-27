<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\IpgOnline\Message\PurchaseResponse;

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
     * Get company name
     * @return string
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
     * @return string
     */
    public function getCompanyLogo()
    {
        return $this->getParameter('company_logo');
    }

    /**
     * Set company logo
     * @param string $companyLogo
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->setParameter('company_logo', $companyLogo);
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
     * 取得测试信用卡账号
     * @return string
     */
    public function getTestCardNumber()
    {
        return $this->getParameter('test_card_number');
    }

    /**
     * 设置测试信用卡账号
     * @param string $testCardNumber
     */
    public function setTestCardNumber($testCardNumber)
    {
        $this->setParameter('test_card_number', $testCardNumber);
    }

    /**
     * 取得测试信用卡过期月份
     * @return string
     */
    public function getTestCardExpirationMonth()
    {
        return $this->getParameter('test_card_expiration_month');
    }

    /**
     * 设置测试信用卡过期月份
     * @param string $month
     */
    public function setTestCardExpirationMonth($month)
    {
        $this->setParameter('test_card_expiration_month', $month);
    }

    /**
     * 取得测试信用卡过期年份
     * @return string
     */
    public function getTestCardExpirationYear()
    {
        return $this->getParameter('test_card_expiration_year');
    }

    /**
     * 设置测试信用卡过期年份
     * @param string $year
     */
    public function setTestCardExpirationYear($year)
    {
        $this->setParameter('test_card_expiration_year', $year);
    }

    /**
     * 取得测试信用卡安全码
     * @return string
     */
    public function getTestCardCvv()
    {
        return $this->getParameter('test_card_cvv');
    }

    /**
     * 设置测试信用卡安全码
     * @param string $number
     */
    public function setTestCardCvv($number)
    {
        $this->setParameter('test_card_cvv', $number);
    }

    /**
     * 取得表单提交地址
     * @return string
     */
    public function getCardFormAction()
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $this->getParameter('card_form_action'));
    }

    /**
     * 设置表单提交地址
     * @param $cardFormAction
     */
    public function setCardFormAction($cardFormAction)
    {
        $this->setParameter('card_form_action', $cardFormAction);
    }

    /**
     * 取得项目域名
     * @return string
     */
    public function getProjectDomain()
    {
        return $this->getParameter('project_domain');
    }

    /**
     * 设置项目域名
     * @param $domain
     */
    public function setProjectDomain($domain)
    {
        $this->setParameter('project_domain', $domain);
    }

    /**
     * 取得项目Vendor文件路径
     * @return string
     */
    public function getProjectVendorDir()
    {
        return $this->getParameter('project_vendor_dir');
    }

    /**
     * 设置项目Vendor文件路径
     * @param $dir
     */
    public function setProjectVendorDir($dir)
    {
        $this->setParameter('project_vendor_dir', $dir);
    }

    /**
     * Get purchase request soap
     * @return string
     */
    public function getSoapXml()
    {
        if ($this->getRequestMethod() !== 'POST') {
            return '';
        }

        /* @var array $payInfo 支付数据 */
        $payInfo = $this->getPayInfo();

        /* @var array $orderInfo 订单数据 */
        $orderInfo = $this->getOrderInfo();

        $storeId = $this->getStoreId();
        $cardNumber = $_POST['card_number'];
        $expirationMonth = $_POST['expiration_month'];
        $expirationYear = $_POST['expiration_year'];
        $cvv = $_POST['cvv'];
        $orderId = $payInfo['pay_id'];
        $payAmount = $orderInfo['pay_amount'];
        $Currency = '978';
        $merchantTransactionId = $orderInfo['order_id'];
        $dynamicMerchantName = $this->getMerchantName();
        $transactionOrigin = 'HK';
        $zip = '0001';

        return <<<SOAP
<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
    <SOAP-ENV:Header/>
    <SOAP-ENV:Body>
        <ipgapi:IPGApiOrderRequest
            xmlns:ipgapi="http://ipg-online.com/ipgapi/schemas/ipgapi"
            xmlns:v1="http://ipg-online.com/ipgapi/schemas/v1">
            <v1:Transaction>
                <v1:CreditCardTxType>
                    <v1:StoreId>$storeId</v1:StoreId>
                    <v1:Type>sale</v1:Type>
                </v1:CreditCardTxType>
                <v1:CreditCardData>
                    <v1:CardNumber>$cardNumber</v1:CardNumber>
                    <v1:ExpMonth>$expirationMonth</v1:ExpMonth>
                    <v1:ExpYear>$expirationYear</v1:ExpYear>
                    <v1:CardCodeValue>$cvv</v1:CardCodeValue>
                </v1:CreditCardData>
                <v1:Payment>
                    <v1:ChargeTotal>$payAmount</v1:ChargeTotal>
                    <v1:Currency>$Currency</v1:Currency>
                </v1:Payment>
                <v1:TransactionDetails>
                    <v1:OrderId>$orderId</v1:OrderId>
                    <v1:MerchantTransactionId>$merchantTransactionId</v1:MerchantTransactionId>
                    <v1:TransactionOrigin>$transactionOrigin</v1:TransactionOrigin>
                    <v1:DynamicMerchantName>$dynamicMerchantName</v1:DynamicMerchantName>
                </v1:TransactionDetails>
                <v1:Billing>
                    <v1:Zip>$zip</v1:Zip>
                </v1:Billing>
            </v1:Transaction>
        </ipgapi:IPGApiOrderRequest>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
SOAP;
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
            'request_method',
            'callback_url',
            'request_url',
            'request_test_url',
            'card_form_action',

            'company_name',
            'company_logo',

            'pay_info',
            'order_info',

            'environment',
            'test_card_number',
            'test_card_expiration_month',
            'test_card_expiration_year',
            'test_card_cvv',

            'trust_cert_file_path',
            'client_ssl_cert_file_path',
            'client_ssl_key_file_path',
            'client_ssl_key_password'
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
