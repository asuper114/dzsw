<?php

/*----------------------------------------------------
	[dzsw] modules/payment/westpay_process.php

	Version: 1.5
	
	
	Last Modified: 2006/3/11 10:00

----------------------------------------------------*/

 $req = 'cmd=_notify-validate';
 foreach ($_POST as $key => $value)
 {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
 }
 $host = "www.westpay.com.cn";
 $port = 80;
 $path = "/pay/ISPN.asp";
 $url = "http://".$host.$path;
 $referer = "http://".$host;
 $len = strlen($req);
 $MerchantOrderNumber = $_POST['MerchantOrderNumber']; //和商户支付命令中的订单号相同
 $WestPayOrderNumber = $_POST['WestPayOrderNumber'];
 $PaidAmount = $_POST['PaidAmount']; //WestPay传回的实际支付金额。
 $MerchantID =$_POST['MerchantID'];

 $fp = fsockopen ($host, 80, $errno, $errstr, 30);
if (!$fp)
{
	echo "$errstr ($errno)<br>\n";
}
else
{
	$request="POST $url HTTP/1.0
Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*
Referer: $referer
Accept-Language: gb2312
Content-Type: application/x-www-form-urlencoded
User-Agent: Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)
Host: $host
Content-Length: $len
Proxy-Connection: Keep-Alive
Pragma: no-cache

$req";

?>
<?php

	fputs ($fp, "$request");
	while (!feof($fp)){
		$res = fgets ($fp, 1024);

		if (strcmp ($res, "VERIFIED") == 0){
					
			if(!is_array($cache_payment_key)){
				include(cacheexists("payment_key"));
			}
			if ($MerchantID == $cache_payment_key['westpay']['pa']['account']['value']) {
				$message = "支付通知验证成功。";
				$state = 1;
			}else{
				$state = 2;
			}
		}else if (strcmp ($res, "INVALID") == 0){
			$message = "支付通知验证失败，请联系商城管理员查看是否支付成功。";
			$state = 3;
		}else{
			$message = "支付通知验证过程中出现错误，请联系商城管理员查看是否支付成功。";
			$state = 4;
		}
	}
	fclose ($fp);
}
 
$message_all = array();
$message_all[] = $message;

$orders_id_array = explode('_',$MerchantOrderNumber);
$orders_id = $orders_id_array['1'];

if($orders_id){
	$payment_type = "westpay_".$orders_id."_".$MerchantOrderNumber;
	$orders_history_data = $db->get_one("select count(*) as count from $table_orders_history where orders_id='$orders_id' and payment_type='$payment_type'");
}

if ($orders_history_data['count'] > 0){
	$result = true;
}elseif ($state == 1){
	if($PaidAmount > 0){

		$db->query("update $table_orders_total set value=value+'$PaidAmount' where orders_id='$orders_id' and classes='paid' ");

	}
		
	$C_ORDER = new order($orders_id);
	$_array_ = array(
		'insert_money'		=> $PaidAmount,
		'payment_type'		=> $payment_type,
		'operator'			=> 'c_',
	);
	$C_ORDER->insert_money($_array_);

	$result = true;
}

if(!is_array($cache_payment_key)){
	include(cacheexists("payment_key"));
}
$payment_title = payment_title($cache_payment_key['westpay'],$lang_payment);

$pay_info = array(
	'money'		=> display_price($PaidAmount),
	'platform'	=> $payment_title,
	'result'	=> $result,
);



?>
