<?php
/**
 * 微信支付JSAPI支付示例
 */

require __DIR__ . '/../../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');
$hostInfo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

//引入配置文件
$wechatpay_config = require('config.php');

//①、获取用户openid
try{
    $tools = new \WeChatPay\JsApiTool($wechatpay_config['appid'], $wechatpay_config['appsecret']);
    $openid = $tools->GetOpenid();
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}

//②、统一下单
$params = [
    'description' => 'sample body', //商品名称
    'out_trade_no' => date("YmdHis").rand(111,999), //商户订单号
    'notify_url' => $hostInfo.dirname($_SERVER['SCRIPT_NAME']).'/notify.php', //异步回调地址
    'amount' => [
        'total' => 150, //支付金额，单位：分
        'currency' => 'CNY'
    ],
	'payer' => [
		'openid' => $openid //用户Openid
	],
    'scene_info' => [
        'payer_client_ip' => $_SERVER['REMOTE_ADDR'], //支付用户IP
	]
];

//发起支付请求
try {
    $client = new \WeChatPay\V3\PaymentService($wechatpay_config);
    $result = $client->jsapiPay($params);
    $jsApiParameters = json_encode($result);
} catch (Exception $e) {
    echo '微信支付下单失败！'.$e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link href="//cdn.staticfile.org/ionic/1.3.2/css/ionic.min.css" rel="stylesheet" />
    <title>微信支付手机版</title>
</head>
<body>
<div class="bar bar-header bar-light" align-title="center">
	<h1 class="title">微信安全支付</h1>
</div>
<div class="has-header" style="padding: 5px;position: absolute;width: 100%;">
<div class="text-center" style="color: #a09ee5;">
<i class="icon ion-information-circled" style="font-size: 80px;"></i><br>
<span>正在跳转...</span>
<script>
	document.body.addEventListener('touchmove', function (event) {
		event.preventDefault();
	},{ passive: false });
    //调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				if(res.err_msg == "get_brand_wcpay_request:ok" ) {
					alert('支付成功')
				}
				//WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
    window.onload = callpay();
</script>
</div>
</div>
</body>
</html>