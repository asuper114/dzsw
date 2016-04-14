<?php

/*----------------------------------------------------
	[dzsw] faq.php 

----------------------------------------------------*/
define('CURRSCRIPT','faq');
require('includes/global.php');

include DIR_dzsw.'includes/user/ini.faq.php';

if($faq_page == 'shopping'){
	$shipping_method = $payment_method = '';
	if(is_array($faq_title['shipping']['subject'])){
		foreach($faq_title['shipping']['subject'] as $k=>$v){
			$shipping_method .= '<li><a href="faq.php?faq_page=shipping#'.$k.'">'.$v.'</a></li>';
		}
	}

	if(is_array($faq_title['payment']['subject'])){
		foreach($faq_title['payment']['subject'] as $k=>$v){
			$payment_method .= '<li><a href="faq.php?faq_page=payment#'.$k.'">'.$v.'</a></li>';
		}
	}
	include DIR_dzsw.'languages/faq_shopping.php';

}elseif($faq_page == 'shipping'){

	$googsself_city = faq_get_goodsself_area();
	$faq_message = array();
	if(is_array($faq_shipping_define)){
		if(!is_array($cache_shipping_define)){
			include(cacheexists("shipping_define"));
		}
		
		foreach($faq_shipping_define as $val){
			$faq_message['shipping'][] = $cache_shipping_define[$val]['desc_faq'];
		}
	}
	include DIR_dzsw.'languages/faq_shipping.php';

}elseif($faq_page == 'server'){

	include DIR_dzsw.'languages/faq_server.php';

}elseif($faq_page == 'member'){
	
	include(cacheexists('usergroup_faq','usergroup'));

	if(is_array($USERGROUPFAQ_CACHE)){
		$usergroup_faq = $usergroup_specials = '';
		$member_higher = array();
		$member_higher['credit'] = '0';
		foreach($USERGROUPFAQ_CACHE as $val){
			if($val['classes'] == 'Member'){
				$usergroup_faq .= '
				<tr>
					<td width="16%"><div align="center"><font color="#FF0000">'.$val['grouptitle'].'</font></div></td>
					<td width="27%"><font color="#FF0000">'.$val['creditshigher'].' - '.$val['creditslower'].'</font></td>
					<td width="10%">
					<div align="center"><font color="#FF0000">'.$val['groupdiscount'].'</font></div></td>
				</tr>
					 ';
			}elseif( $val['classes'] =='Specials'){
				$usergroup_specials .= '
				<tr>
					<td width="16%"><div align="center"><font color="#FF0000">'.$val['grouptitle'].'</font></div></td>
					<td width="27%"><font color="#FF0000">主动申请</font></td>
					<td width="10%">
					<div align="center"><font color="#FF0000">'.$val['groupdiscount'].'</font></div></td>
				</tr>
					 ';
				$specials_title = $val['grouptitle'];
			}
			
			if($val['creditslower'] > $member_higher['credit']){
				$member_higher['title'] = $val['grouptitle'];
				$member_higher['credit'] = $val['creditslower'];
			}
		}
		$usergroup_faq .= $usergroup_specials;
	}
	include DIR_dzsw.'languages/faq_member.php';

}elseif($faq_page == 'payment'){
	
	$googsself_city = faq_get_goodsself_area();

	if(!is_array($cache_payment_key)){
		include(cacheexists("payment_key"));
	}
	if(in_array('banktransfer',$faq_payment_body)){
		
		$faq_message_payment_banktransfer = '';

		if(is_array($cache_payment_key)){
			foreach($cache_payment_key as $val){
				if($val['parentid'] == $cache_payment_key['banktransfer']['id'] && $val['status'])
				{
					$payment_title = payment_title($cache_payment_key[$val['pay_key']],$lang_payment);
					$payment_a = payment_a_title($cache_payment_key[$val['pay_key']],$lang_payment_a);
					$faq_message_payment_banktransfer .= '
				
					<li>'.$payment_title.' </li>
	　　　　　　		<ul>
						<li>'.$payment_a['cartnum']['title'].$payment_a['cartnum']['value'].' </li>
						<li>'.$payment_a['manname']['title'].$payment_a['manname']['value'].'</li>	
					</ul>
			  　
					 ';
				}
			}
		}
	}

	if(in_array('postpay',$faq_payment_body)){
		$payment_a_postpay = payment_a_title($cache_payment_key['postpay'],$lang_payment_a);
		
	}

	include DIR_dzsw.'languages/faq_payment.php';	
}

if($settings['customer_mark'] != 'true'){
   unset($faq_title['member']);
   unset($faq_message['member']);
}

include template('faq_message');

function faq_get_goodsself_area(){
	global $cache_shipping_fee, $cache_shipping, $cache_area;
	if(!is_array($cache_shipping_fee)){
		include(cacheexists("shipping"));
	}
	if(!is_array($cache_shipping)){
		include(cacheexists("shipping"));
	}
	if(is_array($cache_shipping)){
		foreach($cache_shipping as $k=>$v){
			if($v['filename'] == 'goodsself'){
				$googsself_id = $k;
				break;
			}
		}
	}

	$area_data = '';
	if(is_array($cache_shipping_fee)){
		foreach($cache_shipping_fee as $k=>$v){
			if($v['shippingid'] == $googsself_id){
				$area_data .= $v['area'];
			}
		}
	}

	$area_array = explode(',',$area_data);
	if(!is_array($cache_area)){
		include(cacheexists("area"));
	}
	
	$googsself_city = '';
	if(is_array($area_array)){
		foreach($area_array as $val){
			$googsself_city .= $cache_area[$val]['name'].'&nbsp;&nbsp;';
		}     
	}

	return $googsself_city;
}

?>
