<?php
/**
 * 其他微信支付V3接口调用示例
 * 使用\WeChatPay\V3\BaseService中的execute方法调用自定义接口
 */

require __DIR__ . '/../../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');

//引入配置文件
$wechatpay_config = require('config.php');


/**
 * 创建支付分订单API示例
 */
//构造请求参数
$params = [
    'appid' => $wechatpay_config['appid'],
    'out_order_no' => date("YmdHis").rand(111,999), //商户订单号
    'service_id' => '', //服务ID
    'service_introduction' => '', //服务信息
];
//发起请求
try {
    $client = new \WeChatPay\V3\BaseService($wechatpay_config);
    $result = $client->execute('POST', '/v3/payscore/serviceorder', $params);
    print_r($result);
} catch (Exception $e) {
    echo $e->getMessage();
}


/**
 * 商户上传反馈图片API示例
 */
$file_path = dirname(__FILE__).'/pic.png'; //文件路径
$file_name = 'pic.png'; //文件名称

try {
    $client = new \WeChatPay\V3\BaseService($wechatpay_config);
    $result = $client->upload('/v3/merchant-service/images/upload', $file_path, $file_name);
    echo $result['media_id'];
} catch (Exception $e) {
    echo $e->getMessage();
}

