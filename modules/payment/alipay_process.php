<?php

/*----------------------------------------------------
	[dzsw] modules/payment/alipay_process.php 

	Version: 1.5
	
	
	Last Modified: 2006/1/1 10:00

----------------------------------------------------*/

if($orders_id == ''){
	s_redirect('showmessage.php?type=get_alipay_error');
}

$orders_history_data = $db->get_one("select * from $table_orders_history where orders_id='$orders_id' order by ohid desc limit 1");

$order_data = $db->get_one("select payment_method from $table_orders where orders_id='$orders_id' limit 1");

$payment_title = payment_title($cache_payment[$order_data['payment_method']],$lang_payment);

$pay_info = array(
	'money'		=> display_price($orders_history_data['paidnum']),
	'platform'	=> $payment_title,
	'result'	=> 'true',
);

?>
