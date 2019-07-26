<?php

namespace Omnipay\IpgOnline;

use Omnipay\IpgOnline\Message\PurchaseRequest;

class Helper
{
    /**
     * @param PurchaseRequest $request
     * @return array
     */
    static public function sendTransaction(PurchaseRequest $request)
    {
        // 请求的Url
        $url = $request->getRequestUrl();

        // 商户ID
        $storeId = $request->getStoreId();

        // 用户ID
        $userId = $request->getUserId();

        // 用户密码
        $userPassword = $request->getUserPassword();

        // SOAP
        $soap = $request->getSoapXml();

        // Trust file
        $trust_file = $request->getTrustCertFilePath();

        // SSL cert file
        $client_ssl_cert_file = $request->getClientSslCertFilePath();

        // SSL key file
        $client_ssl_key_file = $request->getClientSslKeyFilePath();

        // SSL key password
        $client_ssl_key_password = $request->getClientSslKeyPassword();

        // header
        $header = [
            "Content-Type: text/xml",
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, sprintf('WS%s._.%s:%s', $storeId, $userId, $userPassword));

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soap);

        // DEBUG
        curl_setopt($ch, CURLOPT_VERBOSE, '1');

        // 验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, $trust_file); // 设置让服务端验证的证书的文件名
        curl_setopt($ch, CURLOPT_SSLCERT, $client_ssl_cert_file); // 设置包含PEM格式的SSL证书文件名
        curl_setopt($ch, CURLOPT_SSLKEY, $client_ssl_key_file); // 设置包含SSL私钥的文件名
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $client_ssl_key_password); // 设置在指定了的SSL私钥的密码

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $curl_error = curl_errno($ch);

        curl_close($ch);

        return [
            'success' => true,
            'curl_error' => $curl_error,
            'response' => $response
        ];
    }
}