<?php
/**
 * 微信支付扫码支付示例
 */

require __DIR__ . '/../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');
$hostInfo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

//引入配置文件
$wechatpay_config = require('config.php');

//构造支付参数
$params = [
    'body' => 'sample body', //商品名称
    'out_trade_no' => date("YmdHis").rand(111,999), //商户订单号
    'total_fee' => '150', //支付金额，单位：分
    'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], //支付用户IP
    'notify_url' => $hostInfo.dirname($_SERVER['SCRIPT_NAME']).'/notify.php', //异步回调地址
    'product_id' => '01001',
];

//发起支付请求
try {
    $client = new \WeChatPay\PaymentService($wechatpay_config);
    $result = $client->nativePay($params);
    echo '微信支付下单成功！支付二维码链接：'.$result['code_url'];
} catch (Exception $e) {
    echo '微信支付下单失败！'.$e->getMessage();
}
