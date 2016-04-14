<?php
/*----------------------------------------------------
	[dzsw] includes/faq.php

----------------------------------------------------*/

include DIR_dzsw.'languages/faq_title.php';

if($settings['customer_mark'] == 'true'){																						
	$faq_title['member']['title'] = $lang_faq_title['member_title'];
	$faq_title['member']['subject'] = array(
		'0'=>$lang_faq_title['member_subject_0'],
		'1'=>$lang_faq_title['member_subject_1'],
		'2'=>$lang_faq_title['member_subject_2'],
	);
}

$faq_title['shopping']['title'] = $lang_faq_title['shopping_title'];
$faq_title['shopping']['subject'] = array(
	'0'=>$lang_faq_title['shopping_subject_0'],
	'1'=>$lang_faq_title['shopping_subject_1'],
	'2'=>$lang_faq_title['shopping_subject_2'],
);


$faq_title['shipping']['title'] = $lang_faq_title['shipping_title'];	

if(!is_array($cache_shipping)){
	include(cacheexists("shipping"));
}
$faq_title['shipping']['subject'] = $faq_shipping_body = $faq_shipping_define = array();
if(is_array($cache_shipping)){
	foreach($cache_shipping as $k=>$v){
		if($v['status']){
			$faq_shipping_body[] = $v['filename'];
			if($v['type'] == 'define'){
				$faq_shipping_define[] = $v['id'];
			}
			$faq_title['shipping']['subject'][] =
				shipping_title($v,$lang_shipping);
		}
	}
}


if(in_array('goodsself',$faq_shipping_body))
{
	$allow_payment_goodsarrive = true;
}
$faq_title['payment']['title'] = $lang_faq_title['payment_title'];
if(!is_array($cache_payment)){
	include(cacheexists("payment"));
}
$faq_title['payment']['subject'] = $faq_payment_body = array();
if(is_array($cache_payment)){
	foreach($cache_payment as $k=>$v){
		if($v['status'] && $v['parentid'] == '0'){
			$faq_payment_body[] = $v['pay_key'];
			$faq_title['payment']['subject'][] = payment_title($v,$lang_payment);
		}
	}
}

		 
										
$faq_title['server']['title'] = $lang_faq_title['server_title'];
$faq_title['server']['subject'] = array(
	'0'=>$lang_faq_title['server_subject_0'],
	'1'=>$lang_faq_title['server_subject_1'],
);
                                        
                                        
?>
