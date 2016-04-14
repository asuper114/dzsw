<?php

/*----------------------------------------------------
	[dzsw] modules/payment/chinabank_process.php

	Version: 1.5
	
	
	Last Modified: 2006/3/11 10:00

----------------------------------------------------*/

$v_oid			= trim($_POST['v_oid']);      
$v_pmode		= trim($_POST['v_pmode']);      
$v_pstatus		= trim($_POST['v_pstatus']);      
$v_pstring		= trim($_POST['v_pstring']);      
$v_amount		= trim($_POST['v_amount']);     
$v_moneytype	= trim($_POST['v_moneytype']);     
$remark1		= trim($_POST['remark1']);     
$remark2		= trim($_POST['remark2']);     
$v_md5str		= trim($_POST['v_md5str']); 

if(!is_array($cache_payment_key)){
	include(cacheexists("payment_key"));
}

$key			= $cache_payment_key['chinabank']['pa']['md5key']['value'];

$md5string		= strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));

$v_oid_array = explode('-',$v_oid);
$orders_id = $v_oid_array['2'];

if($orders_id){
	$payment_type = "chinabank_".$orders_id."_".$v_oid;
	$orders_history_data = $db->get_one("select count(*) as count from $table_orders_history where orders_id='$orders_id' and payment_type='$payment_type'");
}

if ($v_md5str == $md5string){
	if ($orders_history_data['count'] > 0){
		$result = true;
	}elseif($v_pstatus == "20"){
		if($v_amount>0){
			$db->query("update $table_orders_total set value=value+'$v_amount' where orders_id='$orders_id' and classes='paid' ");
		}
		
		$C_ORDER = new order($orders_id);
		$_array_ = array(
			'insert_money'		=> $v_amount,
			'payment_type'		=> $payment_type,
			'operator'			=> 'c_',
		);
		$C_ORDER->insert_money($_array_);

		$result = true;

	}else{
		$result = false;
	}
}else{
	$result = false;
}

$payment_title = payment_title($cache_payment_key['chinabank'],$lang_payment);

$pay_info = array(
	'money'		=> display_price($v_amount),
	'platform'	=> $payment_title,
	'result'	=> $result,
);

?>
