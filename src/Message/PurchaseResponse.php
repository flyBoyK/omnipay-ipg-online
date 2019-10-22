<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /* @var string $dateTime */
    private $dateTime = null;

    /* @var string $original_timezone 服务器原本的时区 */
    private $original_timezone = null;

    /* @var PurchaseRequest $request */
    protected $request;

    /**
     * @inheritdoc
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        $this->original_timezone = date_default_timezone_get();

        date_default_timezone_set($this->request->getTimezoneName());
        $this->dateTime = date('Y:m:d-H:i:s');
    }

    /**
     * @inheritdoc
     */
    public function __destruct()
    {
        if ($this->original_timezone) {
            date_default_timezone_set($this->original_timezone);
        }
    }

    /**
     * @inheritdoc
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * @inheritdoc
     */
    public function getRedirectData()
    {
        return array();
    }

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getRedirectUrl()
    {
        return null;
    }

    /**
     * @return string
     */
    private function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Create hash
     *
     * @param $hashAlgorithm
     * @return string
     */
    private function createHash($hashAlgorithm = 'sha256')
    {
        $payInfo = $this->request->getPayInfo();

        $stringToHash = '';
        $stringToHash .= $this->request->getStoreId();
        $stringToHash .= $this->getDateTime();
        $stringToHash .= $payInfo['amount'];
        $stringToHash .= $this->request->getCurrency();
        $stringToHash .= $this->request->getShareSecret();

        $ascii = bin2hex($stringToHash);

        return hash(strtolower($hashAlgorithm), $ascii);
    }

    /**
     *
     * @return string
     */
    public function getRedirectHtml()
    {
        /* @var array $payInfo 支付资料 */
        $payInfo = $this->request->getPayInfo();

        // 是否顯示手機版頁面
        $mobileMode = '';
        if (strpos($payInfo['request_type'], 'app') !== false || strpos($payInfo['request_type'], 'mobile') !== false) {
            $mobileMode = 'true';
        }

        // 用戶語言
        $language = $this->request->getLanguage();

        // 获取时区
        $timezone = $this->request->getTimezoneName();

        // 日期（包括时分秒）
        $dateTime = $this->dateTime;

        // 商户ID
        $storeId = $this->request->getStoreId();

        // 哈希加密方式
        $hashAlgorithm = 'SHA256';

        // 哈希字符串
        $hash = $this->createHash($hashAlgorithm);

        // 运行环境
        $environment = $this->request->getEnvironment();

        // 测试环境使用测试的URL
        if ($environment === 'development') {
            $gatewayApi = $this->request->getRequestTestUrl();
        } else {
            $gatewayApi = $this->request->getRequestUrl();
        }

        // 事務类型
        $txntype = 'sale';

        // model
        $model = 'payonly';

        // 支付数额
        $chargeTotal = $payInfo['amount'];

        // 货币类型
        $currency = $this->request->getCurrency();

        // Callback Url
        $responseFailURL = $this->request->getCallbackUrl() . '?fail=1';

        // Callback Url
        $responseSuccessURL = $this->request->getCallbackUrl();

        // 支付ID
        $payId = $payInfo['pay_id'];

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Redirecting...</title>
    </head>
    <body onload="document.forms[0].submit()">
        <form action="$gatewayApi" method="post">
            <input type="hidden" name="txntype" value="$txntype">
            <input type="hidden" name="timezone" value="$timezone"/>
            <input type="hidden" name="txndatetime" value="$dateTime"/>
            <input type="hidden" name="hash_algorithm" value="$hashAlgorithm"/>
            <input type="hidden" name="hash" value="$hash"/>
            <input type="hidden" name="storename" value="$storeId"/>
            <input type="hidden" name="mode" value="$model"/>
            <input type="hidden" name="chargetotal" value="$chargeTotal"/>
            <input type="hidden" name="currency" value="$currency"/>
            <input type="hidden" name="responseFailURL" value="$responseFailURL"/>
            <input type="hidden" name="responseSuccessURL" value="$responseSuccessURL"/>
            <input type="hidden" name="oid" value="$payId"/>
            <input type="hidden" name="language" value="$language"/>
            <input type="hidden" name="mobileMode" value="$mobileMode"/>
        </form>
    </body>
</html>
HTML;
    }
}
