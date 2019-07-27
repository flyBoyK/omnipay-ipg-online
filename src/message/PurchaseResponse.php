<?php

namespace Omnipay\IpgOnline\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\IpgOnline\Helper;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /* @var PurchaseRequest $request */
    protected $request;

    /* @var string $imageDir 图片路劲 */
    protected $imageDir = 'flyboyk/omnipay-ipg-online/src/message/images';

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
     * Request method == get / 获取表单
     * Request method == post / 提交表单
     *
     * @return string
     */
    public function getRedirectHtml()
    {
        if ($this->request->getRequestMethod() === 'GET') {
            return $this->getTransactionForm();
        } elseif ($this->request->getRequestMethod() === 'POST') {
            return $this->submitTransaction();
        } else {
            return '';
        }
    }

    /**
     * 取得用户填写的表单
     *
     * @return string
     */
    private function getTransactionForm()
    {
        $action             = $this->request->getCardFormAction();
        $companyName        = $this->request->getCompanyName();
        $companyLogo        = $this->request->getCompanyLogo();

        $orderInfo          = $this->request->getOrderInfo();
        $orderId            = $orderInfo['order_id'];
        $totalAmount        = $orderInfo['text_total_amount'];
        $payAmount          = $orderInfo['text_pay_amount'];
        $customerName       = $orderInfo['customer_name'];
        $customerMobile     = $orderInfo['customer_mobile'];
        $customerAddress    = $orderInfo['customer_address'];

        // 测试环境自动填入测试信用卡
        $environment = $this->request->getEnvironment();
        if ($environment === 'test') {
            $cardholder         = 'Master testing';
            $card_number        = $this->request->getTestCardNumber();
            $expiration_month   = $this->request->getTestCardExpirationMonth();
            $expiration_year    = $this->request->getTestCardExpirationYear();
            $cvv                = $this->request->getTestCardCvv();
        } else {
            $cardholder         = '';
            $card_number        = '';
            $expiration_month   = '';
            $expiration_year    = '';
            $cvv                = '';
        }

        $year_options = '';
        for ($i = 0; $i < 20; $i ++) {
            $year_str = substr((string) (date('Y') + $i), -2);

            if ($expiration_year == $year_str) {
                $year_options .= sprintf(
                    "<option value='%s' selected='selected'>%s</option>",
                    $year_str,
                    $year_str
                );
            } else {
                $year_options .= sprintf(
                    "<option value='%s'>%s</option>",
                    $year_str,
                    $year_str
                );
            }
        }

        $month_options = '';
        for ($i = 1; $i <= 12; $i ++) {
            $month_str = $i < 10 ? '0' . $i : (string) $i;

            if ($expiration_month == $month_str) {
                $month_options .= sprintf(
                    "<option value='%s' selected='selected'>%s</option>",
                    $month_str,
                    $month_str
                );
            } else {
                $month_options .= sprintf(
                    "<option value='%s'>%s</option>",
                    $month_str,
                    $month_str
                );
            }
        }

        // 项目域名
        $projectDomain = $this->request->getProjectDomain();

        // 项目Composer vendor路径
        $projectVendorDir = $this->request->getProjectVendorDir();

        // 需要的图片路径
        $imageDir = $projectDomain . $projectVendorDir . '/' . $this->imageDir;

        // 需要的Library路径
        $library = $projectDomain . 'catalog/view/javascript';

        $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no"/>
    <title>IPG online 安全支付</title>
    <link rel="stylesheet" media="screen" href="$library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="$library/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="$library/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="$library/bootstrap/js/bootstrap.min.js"></script>
    <style>
        .content {
            background-color: #FFFFFF;
            padding: 12px 8px;
        }
        .company {
            margin: 23px auto auto 15px;
        }
        .company-text {
            font-size: 29px;
        }
        .card-form {
            margin-top: 20px;
            padding: 15px 13px 30px;
            border-radius: 5px;
            background-color: #fbfbfb;
            box-shadow: 1px 5px 8px 0 #DDDDDD;
        }
        .input-item {
            margin-bottom: 15px;
        }
        .form-label {
            display: inline-block;
            font-weight: 900;
        }
        .label-text {
            font-size: 15px;
            float: left;
        }
        .label-required {
            float: left;
            font-size: 19px;
            margin: auto auto -8px 4px;
            color: red;
        }
        .card-logo  {
            float: left;
            width: 38px;
            margin: auto 1px;
        }
    </style>
</head>
<body>
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 content">
        <div class="clearfix">
            <div class="pull-left logo">
                <img width="88px" src="$companyLogo" alt="">
            </div>
            <div class="pull-left company">
                <div class="company-text"><b>$companyName</b></div>
                安全支付&nbsp;<i class="fa fa-lock fa-lg"></i>
            </div>
        </div>
        <div class="card-form">
            <form action="$action" method="post" name="form_card" id="form_card" enctype="multipart/form-data">
                <div class="input-item input-card-number">
                    <div class="form-label clearfix">
                        <div class="label-text">卡號</div>
                        <div class="label-required">*</div>
                    </div>
                    <div><input type="text" name="card_number" value="$card_number" class="form-control"></div>
                </div>
                <div class="input-item clearfix">
                    <div class="card-logo" data-id="mastercard">
                        <img width="100%" src="$imageDir/mastercard.png" alt="">
                    </div>
                    <div class="card-logo" data-id="visa">
                        <img width="100%" src="$imageDir/visa.png" alt="">
                    </div>
                    <div class="card-logo " data-id="jcb">
                        <img width="100%" src="$imageDir/jcb.png" alt="">
                    </div>
                </div>
                <div class="input-item input-month-and-year">
                    <div class="clearfix">
                        <div style="float:left">
                            <div class="form-label clearfix">
                                <div class="label-text">到期月份</div>
                                <div class="label-required">*</div>
                            </div>
                            <div>
                                <select name="expiration_month" class="form-control">
                                    <option value="0">月</option>
                                    $month_options
                                </select>
                            </div>
                        </div>
                        <div style="float:left; margin-left: 15px">
                            <div class="form-label clearfix">
                                <div class="label-text">到期年份</div>
                                <div class="label-required">*</div>
                            </div>
                            <div>
                                <select name="expiration_year" class="form-control">
                                    <option value="0">年</option>
                                    $year_options
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-item input-cardholder">
                    <div class="form-label clearfix">
                        <div class="label-text">持卡人姓名</div>
                        <div class="label-required">*</div>
                    </div>
                    <div><input type="text" name="cardholder" value="$cardholder" class="form-control"></div>
                </div>
                <div class="input-item input-cvv">
                    <div class="clearfix">
                        <div style="float:left; width: 68px">
                            <div class="form-label clearfix">
                                <div class="label-text">安全碼</div>
                                <div class="label-required">*</div>
                            </div>
                            <div>
                                <input type="text" name="cvv" value="$cvv" class="form-control">
                            </div>
                        </div>
                        <div class="text-info" style="float:left; margin: 32px auto auto 15px">
                            <span><img width="30px" src="$imageDir/csc_other.png" alt=""></span>
                            <span style="font-size: 12px">卡背面顯示的最後<b>3位數字</b></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div style="margin: -5px auto 38px">
                    <div style="font-weight: 900; font-size: 15px">訂單資料</div>
                    <div style="font-size: 12px;margin-top: 5px">
                        <table>
                            <tbody>
                                <tr>
                                    <td style="width: 38px" align="right">編號：</td>
                                    <td>$orderId</td>
                                </tr>
                                <tr>
                                    <td align="right">總額：</td>
                                    <td><b>$totalAmount</b></td>
                                </tr>
                                <tr>
                                    <td align="right">實付：</td>
                                    <td><b>$payAmount</b></td>
                                </tr>
                                <tr>
                                    <td align="right">姓名：</td>
                                    <td>$customerName</td>
                                </tr>
                                <tr>
                                    <td align="right">電話：</td>
                                    <td>$customerMobile</td>
                                </tr>
                                <tr>
                                    <td valign="top" align="right">地址：</td>
                                    <td>$customerAddress</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clearfix">
                    <div><button type="button" id="submit_form" class="btn btn-success btn-block">立即付款</button></div>
                </div>
            </form>
        </div>
        <div class="footer clearfix">
            <div style="float: right; margin: 58px 10px">
                <img src="$imageDir/first_data_logo.png" alt="">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input[name="card_number"]').on('input', function () {
                let value = $(this).val();

                // 已经输入16位则往后输入无效
                let value_len = value.length;
                if (value_len > 19) {
                    $(this).val(value.substr(0, value_len - 1));
                    return;
                }

                // 必须输入数字，否则无效
                if (value) {
                    let int_reg = /\d|-/;
                    if (! int_reg.test(value.substr(-1, 1))) {
                        $(this).val(value.substr(0, value_len - 1));
                        return;
                    }
                }

                let card_num = value.replace(/-/g, '');
                let len = card_num.length;

                // 使用短横线隔开的信用卡号
                let new_card_num = '';
                if (len > 4) {
                    let remainder = len%4;
                    if (remainder > 0) {
                        let offset = len - remainder;
                        new_card_num = card_num.slice(0,offset).match(/\d{4}/g).join("-") + '-' + card_num.slice(0 - remainder);
                    } else {
                        new_card_num = card_num.match(/\d{4}/g).join("-");
                    }
                } else {
                    new_card_num = card_num;
                }
                $(this).val(new_card_num);

                // 判断支持的银行
                if (card_num !== '') {
                    let card_bank = '';
                    let mastercard_reg = /^(5[1-5]\d{4}|677189)\d{0,10}$|^2(?:2(?:2[1-9]|[3-9]\d)|[3-6]\d\d|7(?:[01]\d|20))\d{0,12}$/;
                    if (mastercard_reg.test(card_num)) {
                        card_bank = 'mastercard';
                    }
                    let visa_reg = /^4\d{0,15}$/;
                    if (visa_reg.test(card_num)) {
                        card_bank = 'visa';
                    }
                    let jcb_reg = /^35(28|29|[3-8]\d)\d{0,12}$/;
                    if (jcb_reg.test(card_num)) {
                        card_bank = 'jcb';
                    }
    
                    $('.card-logo').each(function () {
                        if ($(this).data('id') !== card_bank) {
                            $(this).css('opacity', '0.3');
                        } else {
                            $(this).css('opacity', '1');
                        }
                    });
                } else {
                    $('.card-logo').css('opacity', '1');
                }
            });

            // 安全码只能输入3位且都为数字
            $('input[name="cvv"]').on('input', function () {
                let value = $(this).val();

                // 超出3位则输入无效
                let value_len = value.length;
                if (value_len > 3) {
                    $(this).val(value.substr(0, value_len - 1));
                    return false;
                }

                // 必须输入数字，否则无效
                if (value) {
                    let int_reg = /\d/;
                    if (! int_reg.test(value.substr(-1, 1))) {
                        $(this).val(value.substr(0, value_len - 1));
                        return false;
                    }
                }
            });

            // 提交表单
            $('#submit_form').on('click', function () {

                let input_card_number = $('input[name="card_number"]');
                if (input_card_number.val() === '') {
                    alert('請輸入信用卡卡號！'); input_card_number.focus(); return false;
                }

                let input_cvv = $('input[name="cvv"]');
                if (input_cvv.val() === '') {
                    alert('請輸入信用卡安全碼！'); input_cvv.focus(); return false;
                }

                let input_cardholder = $('input[name="cardholder"]');
                if (input_cardholder.val() === '') {
                    alert('請輸入信用卡持卡人姓名！'); input_cardholder.focus(); return false;
                }

                let select_expiration_month = $('select[name="expiration-month"]');
                if (select_expiration_month.val() === '0') {
                    alert('請選擇信用卡到期月份！'); select_expiration_month.focus(); return false;
                }

                let select_expiration_year = $('select[name="expiration-year"]');
                if (select_expiration_year.val() === '0') {
                    alert('請選擇信用卡到期年份！'); select_expiration_year.focus(); return false;
                }

                $('#form_card').submit();
            })
        })
    </script>
</body>
</html>

HTML;
        return $html;
    }

    /**
     * 提交表单到第三方支付
     *
     * @return string
     */
    private function submitTransaction()
    {
        // Request
        $response = Helper::sendTransaction($this->request);
        $response = json_encode($response, JSON_UNESCAPED_UNICODE);

        // Callback Url
        $callback_url = $this->request->getCallbackUrl();

        // 支付资料
        $payInfo = $this->request->getPayInfo();

        // 支付ID
        $payId = $payInfo['pay_id'];

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Redirecting...</title>
    </head>
    <body onload="document.forms[0].submit();">
        <form action="$callback_url" method="post">
            <input type="hidden" name="pay_id" value="$payId">
            <textarea name="response_soap" style="display: none">$response</textarea>
            <p>Redirecting...</p>
        </form>
    </body>
</html>
HTML;
    }

    /**
     * 支付失败问询是否重新支付
     *
     * @param array $result
     * @return string
     */
    public function payFailed(array $result)
    {
        return ''; // TODO
    }

    /**
     * 成功支付直接跳转
     *
     * @param array $result
     * @return string
     */
    public function paySuccess(array $result)
    {
        return '';// TODO
    }
}
