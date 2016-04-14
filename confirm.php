<?php

/*----------------------------------------------------
	[dzsw] confirm.php 

----------------------------------------------------*/

define('CURRSCRIPT','confirm');
require 'includes/global.php';

require DIR_dzsw.'languages/confirm.php';

if (!$customer_id || $customer_id=='') {
    $referer = s_referer();
    s_redirect('login.php?direct_referer='.rawurlencode('confirm.php'));
}

if (!$products = cart_get_product()) {
    s_redirect('cart.php');
}
 
require DIR_dzsw.'includes/user/cla.confirm.php';
$C_CONFIRM = new confirm();

$check_stock = $C_CONFIRM->check_stock();
if($check_stock == false){
	s_redirect('cart.php');
}

$C_CONFIRM->customer_data();
$customer_data = $C_CONFIRM->customer_data;
if(!$customer_data['shipto']){
    s_redirect('address_ship.php');
}

if($customer_data['deli_s_bill'] == '0'){
	if(!$customer_data['billto']){
		s_redirect('address_bill.php');
	}
}

$check_shipping = $C_CONFIRM->check_shipping();
if(!$check_shipping){
	s_redirect('shipping_method.php');
}

$check_payment = $C_CONFIRM->check_payment();
if(!$check_payment){
	s_redirect('payment_method.php');
}

$C_CONFIRM->shipping_data();
$shipping_data = $C_CONFIRM->shipping_data;
if(!is_array($cache_area)){
	include(cacheexists('area'));
}
$shipping_data['country']	= $cache_area[$shipping_data['country']]['name'];
$shipping_data['province']	= $cache_area[$shipping_data['province']]['name'];
$shipping_data['city']		= $cache_area[$shipping_data['city']]['name'];

if($C_CONFIRM->customer_data['deli_s_bill'] == '0'){
	$C_CONFIRM->billing_data();
	$billing_data = $C_CONFIRM->billing_data;
	$billing_data['country']	= $cache_area[$billing_data['country']]['name'];
	$billing_data['province']	= $cache_area[$billing_data['province']]['name'];
	$billing_data['city']		= $cache_area[$billing_data['city']]['name'];
}

$C_CONFIRM->products_data();
$products_data = $C_CONFIRM->products_data;

$C_CONFIRM->order_total_data();
$order_total = $C_CONFIRM->order_total_data;

if(!is_array($cache_payment)){
	include(cacheexists("payment"));
}
$payment_title = payment_title($cache_payment[$C_CONFIRM->customer_data['payment_method']],$lang_payment);

if(!is_array($cache_shipping)){
	include(cacheexists("shipping"));
}
$shipping_method_array = $cache_shipping[$C_CONFIRM->customer_data['shipping_method']];

$confirm_step = confirm_step($currscript);

$page_trail[] = array('title'=>$lang_confirm['navbar']);
$page_position = page_trail();
include template("confirm");


?>

