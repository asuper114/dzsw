<?php

/*
	[dzsw] modules/payment/alipay_form.php

	Version: 1.5
	
	
	Last Modified: 2006/3/11 10:00

*/


$form_value = $form_info = array();
$form_value[partner]	= '10014300001';

$form_info[ac]	= 'cmd0001subject'.$settings['store_name'].'order_no'.$timestamp.'_'.$orders_id.'_1price'.$pay_total.'type1number1transport3seller'.$cache_payment[$order_data['payment_method']]['pa']['account']['value'].'partner'.$form_value['partner'].$cache_payment[$order_data['payment_method']]['pa']['safenum']['value'];

$form_info[form_action]	=	'https://www.alipay.com/payto:'.$cache_payment[$order_data['payment_method']]['pa']['account']['value'];

$form_info[hidden]		=	
	'<input name="cmd" value="0001" type="hidden">'. 
	'<input name="subject" value="'.$settings['store_name'].'" type="hidden">'. 
	'<input name="order_no" value="'.$timestamp.'_'.$orders_id.'_1" type="hidden">'. 
	'<input name="price" value="'.$pay_total.'" type="hidden">'.   
	'<input name="type" value="1" type="hidden">'.
	'<input name="number" value="1" type="hidden">'.
	'<input name="transport" value="3" type="hidden">'.
	//'<input name="readonly" value="true" type="hidden">'.  
	//'<input name="buyer" value="'.$customer_email.'" type="hidden">'.
	'<input name="partner" value="'.$form_value['partner'].'" type="hidden">'.
	'<input name="ac" value="'.md5($form_info['ac']).'" type="hidden">';
											

?>
