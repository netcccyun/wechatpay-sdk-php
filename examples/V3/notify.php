<?php
/**
 * 微信支付异步回调页面示例
 */

require __DIR__ . '/../../vendor/autoload.php';

//引入配置文件
$wechatpay_config = require('config.php');

$isSuccess = true;
try{
    $client = new \WeChatPay\V3\PaymentService($wechatpay_config);
    $data = $client->notify();
    //签名校验成功且订单支付成功，根据商户订单号($data['out_trade_no'])在商户系统中处理业务


}catch(Exception $e){
    //签名校验失败或订单支付失败
    $isSuccess = false;
    $errmsg = $e->getMessage();
}

//给微信支付返回的内容
$client->replyNotify($isSuccess, $errmsg);
