<?php
/**
 * 微信商家转账到零钱示例
 */

require __DIR__ . '/../../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');

//引入配置文件
$wechatpay_config = require('config.php');

$client = new \WeChatPay\V3\TransferService($wechatpay_config);


$out_batch_no = date("YmdHis").rand(111,999);
$out_detail_no = date("YmdHis").rand(111,999);

//转账明细
$transfer_detail = [
    'out_detail_no' => $out_detail_no, //商家明细单号
    'transfer_amount' => 150, //转账金额
    'transfer_remark' => '备注内容', //转账备注
    'openid' => '', //收款用户openid
    'user_name' => $client->rsaEncrypt('姓名') //收款用户姓名（不传则不校验）
];
//接口入参
$param = [
    'out_batch_no' => $out_batch_no, //商家批次单号
    'batch_name' => '转账给XX', //批次名称
    'batch_remark' => date("YmdHis"), //批次备注
    'total_amount' => 150, //转账总金额
    'total_num' => 1, //转账总笔数
    'transfer_detail_list' => [ //转账明细列表
        $transfer_detail
    ],
];

//发起转账请求
try {
    $result = $client->transfer($param);
    $batch_id = $result['batch_id'];
    echo '转账发起成功！微信转账批次单号：'.$batch_id;
} catch (Exception $e) {
    echo '转账发起失败！'.$e->getMessage();
    exit;
}

//查询转账明细
try{
    $result = $client->transferoutdetail($out_batch_no, $out_trade_no);
    print_r($result);
} catch (Exception $e) {
    echo '查询失败！'.$e->getMessage();
    exit;
}
