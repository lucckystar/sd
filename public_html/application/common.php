<?php
// 密码加盐Hash
function encodePass($passSHA){
	$passSHA = strtolower($passSHA);
	$data['salt'] = strtolower(substr(uniqid(),7,6));
	$data['hash'] = strtoupper(MD5($passSHA.$data['salt']));
	return $data;
}
// 密码校验
function checkPass($passSHA,$salt,$passHASH){
	$passSHA = strtolower($passSHA);
	$salt = strtolower($salt);
	$res = strtoupper(MD5($passSHA.$salt));
	if($passHASH===$res){
		return true;
	}else{
		return false;
	}
}

//返回json字符串处理
function returnJson($code,$msg,$data=null){
    $arr = ['code'=>$code,'msg'=>$msg];
    if (isset($data)) {
        $arr['data'] = $data;
    }else{
        $arr['data'] = '';
    }
    return json_encode($arr);
}

//生成二维码方法
function qrcode($msg){
    import('PhpQrcode.phpqrcode',EXTEND_PATH);
    $errorCorrectionLevel = 'L';  //容错级别
    $matrixPointSize = 5;      //生成图片大小
    $filename = 'public'.DS.'static'.DS.'qrcode/'.time().rand(111111,999999).'.png'; //图片保存路径
    QRcode::png($msg,ROOT_PATH.$filename,$errorCorrectionLevel,$matrixPointSize,2);
    return $filename;
}

//发送短信华为云
function sendSMS($phone,$msg){
	$headers = ["Content-type: application/json;charset='utf-8'","Accept: application/json","Cache-Control: no-cache","Pragma: no-cache"];
	$data = '{"auth": {"identity": {"methods": ["password"],"password": {"user": {"name": "p13920425572","password": "p1996118","domain": {"name": "p13920425572"}}}},"scope": {"project": {"id": "43b359ed8a104d0da0fb856c934ba4fe"}}}}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'https://iam.cn-north-1.myhuaweicloud.com/v3/auth/tokens');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36");
	$res = curl_exec($ch);
	curl_close($ch);

	$res_start = strpos($res,'X-Subject-Token:');
	$headers[] = 'X-Auth-Token: '.substr($res,$res_start+16,strpos($res,'Strict-Transport-Security:')-$res_start);
	$data = '{"endpoint":"'.$phone.'","message":"'.$msg.'","sign_id":"a37255f21ba1474a8c788fe740c32b4f"}';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,'https://smn.cn-north-1.myhuaweicloud.com/v2/43b359ed8a104d0da0fb856c934ba4fe/notifications/sms');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}

//微信-支付
function wxpay(){
    import('WxPay.lib.WxPay_Api',EXTEND_PATH);
    import('WxPay.example.WxPay_JsApiPay',EXTEND_PATH);
    import('WxPay.example.WxPay_Config',EXTEND_PATH);
    import('WxPay.example.log',EXTEND_PATH);

    $tools = new JsApiPay();
    $openId = $tools->GetOpenid();
    //统一下单
    $input = new WxPayUnifiedOrder();
    $input->SetBody("test");
    $input->SetAttach("test");
    $input->SetOut_trade_no("sdkphp".date("YmdHis"));
    $input->SetTotal_fee("1");
    $input->SetTime_start(date("YmdHis"));
    $input->SetTime_expire(date("YmdHis", time() + 600));
    $input->SetGoods_tag("test");
    $input->SetNotify_url("http://paysdk.weixin.qq.com/notify.php");
    $input->SetTrade_type("JSAPI");
    $input->SetOpenid($openId);
    $config = new WxPayConfig();
    $order = WxPayApi::unifiedOrder($config, $input);
    echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
    printf_info($order);
    $jsApiParameters = $tools->GetJsApiParameters($order);

    //获取共享收货地址js函数参数
    $editAddress = $tools->GetEditAddressParameters();
}

//支付宝-转账到个人
function ali_withdrawal($out_trade_no,$amount,$account){
    import('ALiPay.AopSdk',EXTEND_PATH);
    $config_alipay = config('dazhu.alipay');
    $AopClient = new AopClient;
    $AopClient->gatewayUrl = "https://openapi.alipay.com/gateway.do";
    $AopClient->appId = $config_alipay['appId'];
    $AopClient->rsaPrivateKey = $config_alipay['rsaPrivateKey'];
    $AopClient->alipayrsaPublicKey = $config_alipay['alipayrsaPublicKey'];
    $AopClient->format = "json";
    $AopClient->charset= "UTF-8";
    $AopClient->signType= "RSA2";

    $apppay = new AlipayFundTransToaccountTransferRequest();
    $apppay->setBizContent("{" .
    "\"out_biz_no\":\"".$out_trade_no."\"," .
    "\"payee_type\":\"ALIPAY_USERID\"," .
    "\"payee_account\":\"".$account."\"," .
    "\"amount\":\"".$amount."\"," .
    "\"remark\":\"用户提现\"" .
    "}");
    $response = $AopClient->execute($apppay); 
    $responseNode = str_replace(".", "_", $apppay->getApiMethodName()) . "_response";
    // $resultCode = $response->$responseNode->sub_msg;
    // var_dump($resultCode);exit;
    $resultCode = $response->$responseNode->code;
    if(!empty($resultCode)&&$resultCode == 10000){
        return true;
    } else {
        return false;
    }
}
//支付宝-支付
function alipay($title,$number,$price,$notify){
    import('ALiPay.AopSdk',EXTEND_PATH);
    $config_alipay = config('dazhu.alipay');
    $AopClient = new AopClient;
    $AopClient->gatewayUrl = "https://openapi.alipay.com/gateway.do";
    $AopClient->appId = $config_alipay['appId'];
    $AopClient->rsaPrivateKey = $config_alipay['rsaPrivateKey'];
    $AopClient->alipayrsaPublicKey = $config_alipay['alipayrsaPublicKey'];
    $AopClient->format = "json";
    $AopClient->charset= "UTF-8";
    $AopClient->signType= "RSA2";

    $apppay = new AlipayTradeAppPayRequest();
    $apppay->setNotifyUrl($notify);
    $apppay->setBizContent("{" .
    "\"subject\":\"".$title."\"," .
    "\"out_trade_no\":\"".$number."\"," .
    "\"timeout_express\":\"15m\"," .
    "\"total_amount\":\"".$price."\"," .
    "\"product_code\":\"QUICK_MSECURITY_PAY\"" .
    "}");
    $response = $AopClient->sdkExecute($apppay);
    return ($response);
}
//支付宝-退款
function alipay_refund($out_trade_no,$refund_amount){
    import('ALiPay.AopSdk',EXTEND_PATH);
    $config_alipay = config('dazhu.alipay');
    $AopClient = new AopClient;
    $AopClient->gatewayUrl = "https://openapi.alipay.com/gateway.do";
    $AopClient->appId = $config_alipay['appId'];
    $AopClient->rsaPrivateKey = $config_alipay['rsaPrivateKey'];
    $AopClient->alipayrsaPublicKey = $config_alipay['alipayrsaPublicKey'];
    $AopClient->format = "json";
    $AopClient->charset= "UTF-8";
    $AopClient->signType= "RSA2";

    $apppay = new AlipayTradeRefundRequest();
    $apppay->setBizContent("{" .
    "\"out_trade_no\":\"".$out_trade_no."\"," .
    "\"refund_amount\":\"".$refund_amount."\"" .
    "}");
    $response = $AopClient->execute($apppay);
    $responseNode = str_replace(".", "_", $apppay->getApiMethodName()) . "_response";
    $resultCode = $response->$responseNode->code;
	if(!empty($resultCode)&&$resultCode == 10000){
	 	return true;
	} else {
		return false;
	}
}

function Jpush($title,$msg,$data,$alias=NULL){
    import('Jpush.autoload',EXTEND_PATH);
    $client = new JPush\Client('ed90d7094dc7ed5b50a2ddc5','a06f0bbbb51fd08b1d0c4ecd');
    $pusher = $client->push();
    $pusher->setPlatform('all');
    if ($alias === NULL) {
        $pusher->addAllAudience();
    }else{
        $pusher->addAlias($alias);
    }
    $send_content['title'] = $title;
    $send_content['content_type'] = 'text';
    if (!empty($data)) {
        $send_content['extras'] = $data;
    }
    $pusher->message($msg,$send_content);
    // $pusher->setNotificationAlert($msg,$send_content);
    // $pusher->iosNotification($msg,$send_content);
    // $pusher->androidNotification($msg,$send_content);
    try {
        $pusher->send();
    } catch (\JPush\Exceptions\JPushException $e) {
        return false;
    }
}

//极光即时通讯---注册用户
function JMessage($username,$password){
    import('JMessage.autoload',EXTEND_PATH);
    $client = new JMessage\JMessage('de77b5a6c605b0bc5b0f44f4','d3b33eceda2531dfc29b0578');
    $user = new JMessage\IM\User($client);
    return $user->register($username, $password);
}

function JM_register_update($username,$nickname){//注册修改用户默认资料
    import('JMessage.autoload',EXTEND_PATH);
    $client = new JMessage\JMessage('de77b5a6c605b0bc5b0f44f4','d3b33eceda2531dfc29b0578');
    $user = new JMessage\IM\User($client);
    $resource = new JMessage\IM\Resource($client);
    $upload = $resource->upload('file',APP_PATH.'/../public/uploads/001/initial.png');//修改这个地址用变量拼凑一下
    // var_dump($upload['body']['media_id']);exit();
    return $response = $user->update($username,['nickname' =>$username,'avatar' =>$upload['body']['media_id']]);
}

function JM_update_information($username,$nickname,$avatar){//修改用户资料
    import('JMessage.autoload',EXTEND_PATH);
    $client = new JMessage\JMessage('de77b5a6c605b0bc5b0f44f4','d3b33eceda2531dfc29b0578');
    $user = new JMessage\IM\User($client);
    $resource = new JMessage\IM\Resource($client);
    $upload = $resource->upload('file',APP_PATH.'/../public/uploads/'.$avatar.'');//修改这个地址用变量拼凑一下
    // var_dump($upload['body']['media_id']);exit();
    $response = $user->update($username,['nickname' =>$username,'avatar' =>$upload['body']['media_id']]);
    // var_dump($response);exit();
    return $response = $user->update($username,['nickname' =>$username,'avatar' =>$upload['body']['media_id']]);
}

function JM_user($username){//修改用户资料
    import('JMessage.autoload',EXTEND_PATH);
    $client = new JMessage\JMessage('de77b5a6c605b0bc5b0f44f4','d3b33eceda2531dfc29b0578');
    $user = new JMessage\IM\User($client);
    $user->show($username);
    return $user->show($username);
}

function JM_blacklist($username){//获取用户黑名单列表
    import('JMessage.autoload',EXTEND_PATH);
    $client = new JMessage\JMessage('de77b5a6c605b0bc5b0f44f4','d3b33eceda2531dfc29b0578');
    $user = new JMessage\IM\User($client);
    $blacklist = new JMessage\IM\Blacklist($client);
    return $blacklist->listAll($username);
}

function JM_show($username){
    import('JMessage.autoload',EXTEND_PATH);
    $client = new JMessage\JMessage('de77b5a6c605b0bc5b0f44f4','d3b33eceda2531dfc29b0578');
    $user = new JMessage\IM\User($client);
    return $user->show($username);
}
