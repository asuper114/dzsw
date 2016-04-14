<!-- 支付宝 接口代码 开始 -->

<?php
/*----------------------------------------------------
	[dzsw] alipay_notify.php 
----------------------------------------------------*/
define('CURRSCRIPT','alipay_notify');

require('includes/global.php');

if(!is_array($cache_payment_key)){
	include(cacheexists("payment_key"));
}
$selleremail = $cache_payment_key['alipay']['pa']['account']['value'];

$r_msg_id	= $_GET['msg_id'];
$r_order_no	= $_GET['order_no']; 
$r_gross	= $_GET['gross'];
$r_buyer_email	= $_GET['buyer_email'];
$r_buyer_name	= $_GET['buyer_name'];
$r_buyer_address	= $_GET['buyer_address'];
$r_buyer_zipcode	= $_GET['buyer_zipcode'];
$r_buyer_tel	= $_GET['buyer_tel'];
$r_buyer_mobile	= $_GET['buyer_mobile'];
$r_action	= $_GET['action'];
$r_date	= $_GET['date'];
$r_ac	= $_GET['ac'];

/*以下代码用于验证反馈信息的真实性**********************************************************************************/
$str2notify	= 'http://notify.alipay.com/trade/notify_query.do?msg_id=' . $r_msg_id;
$str2notify	.= '&email='.$selleremail.'&order_no=' . $r_order_no;
$notifyresult = file_get_contents($str2notify);

$str = "msg_id".$r_msg_id."order_no".$r_order_no."gross".$r_gross."buyer_email".$r_buyer_email."buyer_name".$r_buyer_name."buyer_address".$r_buyer_address."buyer_zipcode".$r_buyer_zipcode."buyer_tel".$r_buyer_tel."buyer_mobile".$r_buyer_mobile."action".$r_action."date".$r_date.$cache_payment_key['alipay']['pa']['safenum']['value'];
$str_md5ed = md5($str);

/********************************************************************************************************************/
$str2 = "msg_id".$r_msg_id."action".$r_action."date".$r_date.$cache_payment_key['alipay']['pa']['safenum']['value'];
$str_md5ed2 = md5($str);

$time_detail = gmdate($settings['date_format'].' H:i:s', $timestamp+ $settings['time_ofset'] * 3600);

writefile(DIR_dzsw.'data/onlinepay/alipay/','notify.txt',"$timestamp\t$time_detail\t$r_action\t$r_order_no\t$r_msg_id\n");

if($r_action == "test"){
	writefile(DIR_dzsw.'data/onlinepay/alipay/','test.txt',"$timestamp\t$time_detail\n");
	echo 'Y'; 
	exit;
}

if($str_md5ed != $r_ac){
	writefile(DIR_dzsw.'data/onlinepay/alipay/','error.txt',$timestamp."\t".$time_detail."\t".$r_order_no."\n");
	s_redirect('showmessage.php?type=get_alipay_error');
}

$orders_id_array = explode('_',$order_no);
$orders_id = $orders_id_array['1'];
$orders_id_time = $orders_id_array['2'];

if($orders_id){
	$payment_type = "alipay_".$orders_id."_".$r_order_no;
	$orders_history_data = $db->get_one("select count(*) as count from $table_orders_history where orders_id='$orders_id' and payment_type='$payment_type'");
}

if($orders_history_data['count'] < 1){
	if($r_action == 'sendOff'){
		$db->query("update $table_orders_total set value=value+'".$r_gross."' where orders_id='$orders_id' and classes='paid' ");

		$C_ORDER = new order($orders_id);
		$_array_ = array(
			'insert_money'		=> $r_gross,
			'payment_type'		=> $payment_type,
			'operator'			=> 'c_',
		);
		$C_ORDER->insert_money($_array_);
		writefile(DIR_dzsw.'data/onlinepay/alipay/count.txt',$timestamp."\t".$time_detail."\t".$r_order_no."\n");
		if($r_msg_id != ''){
			echo 'Y';
			exit;
		}else{
			s_redirect('get_onlinepay.php?paytype=alipay&orders_id='.$orders_id);
		}
	}elseif($r_action == 'checkOut'){
		echo 'Y';
	}
}else{
	if($r_action == 'sendOff'){
		if($r_msg_id != ''){
			echo 'Y';
			exit;
		}else{
			s_redirect('get_onlinepay.php?paytype=alipay&orders_id='.$orders_id);
		}
	}elseif($r_action == 'checkOut'){
		echo 'Y';
	}
}

?>

<!-- 支付宝 接口代码 结束 -->