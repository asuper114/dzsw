<?php

/*
	[dzsw] modules/payment/chinabank_form.php

	Version: 1.5
	
	
	Last Modified: 2006/3/11 10:00

*/

$form_value = $form_info = array();

$form_value[v_mid]			= $cache_payment[$order_data['payment_method']]['pa']['v_mid']['value'];
$form_value[v_oid]			= date('Ymd',$timestamp)."-".$form_value[v_mid]."-".$order_data['orders_id']."-".date('His',$timestamp);
$form_value[v_amount]		= $pay_total;
$form_value[v_moneytype]	= $cache_payment[$order_data['payment_method']]['pa']['v_moneytype']['value'];
$form_value[v_url]			= $settings['storeurl'].'/get_onlinepay.php?paytype=chinabank';
$form_value[style]			= $cache_payment[$order_data['payment_method']]['pa']['style']['value'];
$form_value[key]			= $cache_payment[$order_data['payment_method']]['pa']['md5key']['value'];
$form_value[v_md5info]		= $form_value[v_amount].$form_value[v_moneytype].$form_value[v_oid].$form_value[v_mid].$form_value[v_url].$form_value[key];
$form_value[v_md5info]		= strtoupper(md5($form_value[v_md5info]));

$form_info[form_action]	=	'https://pay.chinabank.com.cn/select_bank';

$form_info[hidden]		=	
	'<input type="hidden" name="v_mid"    value="'.$form_value[v_mid].'">'. 
	'<input type="hidden" name="v_oid"     value="'.$form_value[v_oid].'">'. 
	'<input type="hidden" name="v_amount" value="'.$form_value[v_amount].'">'. 
	'<input type="hidden" name="v_moneytype"  value="'.$form_value[v_moneytype].'">'. 
	'<input type="hidden" name="v_url"  value="'.$form_value[v_url].'">'. 
	'<input type="hidden" name="style"  value="'.$form_value[style].'">'. 
	'<input type="hidden" name="v_md5info"   value="'.$form_value[v_md5info].'">'. 
	'<input type="hidden" name="remark1"   value="">'. 
	'<input type="hidden" name="remark2"   value="">';

?>
