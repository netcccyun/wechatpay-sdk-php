<?php

/**
 * 微信支付商户信息配置文件
 * APIv3版本
 */
$wechatpay_config = [
    /**
     * 绑定支付的APPID
     */
    'appid' => '',

    /**
     * 商户号
     */
    'mchid' => '',

    /**
     * 商户APIv3密钥
     */
    'apikey' => '',

    /**
     * 公众帐号secert（仅JSAPI支付需要配置）
     * 
     * 获取说明：https://kf.qq.com/faq/181105JJNbmm181105eUZfee.html
     */
    'appsecret' => '',


    /**
     * 「商户API私钥」文件路径
     */
    'merchantPrivateKeyFilePath' => dirname(__FILE__).'/cert/apiclient_key.pem',

    /**
     * 「商户API证书」的「证书序列号」
     */
    'merchantCertificateSerial' => '',

    /**
     * 「微信支付平台证书」文件路径
     *  这个证书不需要上传，只需设置好路径，会自动下载并保存
     */
    'platformCertificateFilePath' => dirname(__FILE__).'/cert/cert.pem',


    /**
     * 子商户号
     * 服务商模式子商户需要填写
     */
    //'sub_mchid' => '',

    /**
     * 子商户APPID（可留空）
     */
    //'sub_appid' => '',

    /**
     * 是否电商收付通
     * 服务商模式可配置，需同时填写子商户号
     */
    //'ecommerce' => false,

];
return $wechatpay_config;
