<?php

/**
 * 微信支付商户信息配置文件
 * APIv2版本
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
     * 商户APIv2密钥
     */
    'apikey' => '',

    /**
     * 公众帐号secert（仅JSAPI支付需要配置）
     * 
     * 获取说明：https://kf.qq.com/faq/181105JJNbmm181105eUZfee.html
     */
    'appsecret' => '',


    /**
     * 商户证书路径（仅退款、撤销订单时需要）
     */
    'sslcert_path' => '/path/to/apiclient_cert.pem',

    /**
     * 商户证书私钥路径（仅退款、撤销订单时需要）
     */
    'sslkey_path' => '/path/to/apiclient_key.pem',


    /**
     * 子商户号
     * 服务商模式子商户需要填写
     */
    //'sub_mchid' => '',

    /**
     * 子商户APPID（可留空）
     */
    //'sub_appid' => '',
];
return $wechatpay_config;
