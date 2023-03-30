<?php
/**
 * 微信支付交易退款示例
 */

require __DIR__ . '/../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');

//引入配置文件
$wechatpay_config = require('config.php');

//构造退款参数
$params = [
    'transaction_id' => '', //微信支付订单号
    'out_refund_no' => date("YmdHis").rand(111,999), //商户退款单号
    'total_fee' => '150', //支付金额，单位：分
    'refund_fee' => '150', //退款金额，单位：分
];

//发起退款请求
try {
    $client = new \WeChatPay\PaymentService($wechatpay_config);
    $result = $client->refund($params);
    echo '退款成功！退款金额：'.$result['refund_fee'];
} catch (Exception $e) {
    echo '退款失败！'.$e->getMessage();
}
