<?php
session_start();/////////
/*----------------------------------------------------
	[dzsw] showmessage.php 

----------------------------------------------------*/
define('CURRSCRIPT','showmessage');

require('includes/global.php');

require DIR_dzsw.'languages/message.php';

if($type == 'register_success'){
	$message_show = array(
		'message'	=> $lang_message['register_success'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'gbook_write_success'){
echo "<script type='text/javascript'>alert(".print_r($_SESSION['AAA']).");</scritp>";/////////////
	$message_show = array(
		'message'	=> $lang_message['gbook_write_success'],
		'redirect'	=> 'gbook.php',
	);
}elseif($type == 'get_password_success'){
	$message_show = array(
		'message'	=> $lang_message['get_password_success'],
		'redirect'	=> 'index.php',
	);
}elseif($type == 'get_password_error'){
	$message_show = array(
		'message'	=> $lang_message['get_password_error'],
		'redirect'	=> 'get_password.php',
	);
}elseif($type == 'login_success'){
	$message_show = array(
		'message'	=> $lang_message['login_success'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'logoff_success'){
	$message_show = array(
		'message'	=> $lang_message['logoff_success'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'orders_idnoexist'){
	$message_show = array(
		'message'	=> LANG_MESSAGE_EMPTY,
		'redirect'	=> 'javascript',
	);
}elseif($type == 'myaccount_email'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_email'],
		'redirect'	=> 'myaccount.php',
	);
}elseif($type == 'myaccount_password'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_password'],
		'redirect'	=> 'myaccount.php',
	);
}elseif($type == 'myaccount_address_edit'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_address_edit'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_address_edit_isnotyou'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_address_edit_isnotyou'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_address_delete_isnotyou'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_address_delete_isnotyou'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_address_delete'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_address_delete_success'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_detail_1'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_detail_1'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_update_success'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_update_success'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_isnotyou'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_isnotyou'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_idempty'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_idempty'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_cannotcancel'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_cannotcancel'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_iscancel'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_iscancel'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_cancelsuccess'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_iscancel'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_cpaymentsuccess'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_cpaymentsuccess'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'myaccount_order_noallow_caddress'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_order_noallow_caddress'],
		'redirect'	=> 'referer',
	);
}elseif($type == 'myaccount_qqmsn_update_success'){
	$message_show = array(
		'message'	=> $lang_message['myaccount_qqmsn_update_success'],
		'redirect'	=> 'myaccount.php?type=qqmsn',
	);
}elseif($type == 'product_review_notfont'){
	$message_show = array(
		'message'	=> $lang_message['product_review_notfont'],
		'redirect'	=> 'index.php',
	);
}elseif($type == 'product_review_success'){
	$message_show = array(
		'message'	=> $lang_message['product_review_success'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'product_notfont'){
	$message_show = array(
		'message'	=> $lang_message['product_notfont'],
		'redirect'	=> 'index.php',
	);
}elseif($type == 'class_notfont'){
	$message_show = array(
		'message'	=> $lang_message['class_notfont'],
		'redirect'	=> 'index.php',
	);
}elseif($type == 'dzsw_clearcookie_browse'){
	$message_show = array(
		'message'	=> $lang_message['dzsw_clearcookie_browse'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'dzsw_clearcookie_search'){
	$message_show = array(
		'message'	=> $lang_message['dzsw_clearcookie_search'],
		'redirect'	=> s_referer(),
	);
}elseif($type == 'lossremark_success'){
	$message_show = array(
		'message'	=> $lang_message['lossremark_success'],
		'redirect'	=> 'referer',
	);
}else{
	$message_show = array(
		'message'	=> $lang_message['unfinend'],
		'redirect'	=> 'index.php',
	);
}

if($message_show['redirect'] == 'referer'){
	$message_show['redirect'] = $_SERVER['HTTP_REFERER'];	
}

$pageredirect = $message_show['redirect'];
$message = $message_show['message'];

if($message_show['redirect'] != 'javascript'){
	$header_redirect = $message_show['redirect'] ? '<meta http-equiv="refresh" content="2;url='.$message_show['redirect'].'">' : NULL;
}

include template('showmessage');
exit;

?>
