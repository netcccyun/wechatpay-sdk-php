<?php
/**
 * 微信支付H5支付示例
 */

require __DIR__ . '/../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');
$hostInfo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

//引入配置文件
$wechatpay_config = require('config.php');

//支付场景信息，H5支付必传
$scene_info = [
    'h5_info' => [
        'type' => 'Wap',
        'wap_url' => $hostInfo,
        'wap_name' => '在线商城'
    ]
];
//构造支付参数
$params = [
    'body' => 'sample body', //商品名称
    'out_trade_no' => date("YmdHis").rand(111,999), //商户订单号
    'total_fee' => '150', //支付金额，单位：分
    'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], //支付用户IP
    'notify_url' => $hostInfo.dirname($_SERVER['SCRIPT_NAME']).'/notify.php', //异步回调地址
    'scene_info' => json_encode($scene_info, JSON_UNESCAPED_UNICODE),
];

//H5支付成功跳转地址
$redirect_url = $hostInfo.dirname($_SERVER['SCRIPT_NAME']).'/return.php';

//发起支付请求
try {
    $client = new \WeChatPay\PaymentService($wechatpay_config);
    $result = $client->h5Pay($params);
    
    //H5支付跳转地址
    $url=$result['mweb_url'].'&redirect_url='.urlencode($redirect_url);
    ob_clean();
    header('Location: '.$url);
    
} catch (Exception $e) {
    echo '微信支付下单失败！'.$e->getMessage();
}
