<?php

/*----------------------------------------------------
	[dzsw] shipping_method.php 

----------------------------------------------------*/

define('CURRSCRIPT','shipping_method');
require('includes/global.php');

if(!$customer_id || $customer_id=='') {
    $referer = s_referer();
    s_redirect('login.php?irect_referer='.rawurlencode('shipping_method.php'));
}

require DIR_dzsw.'languages/shipping_method.php';

if($_POST['shippingid']){
	$db->query("update $table_customers set shipping_method='".$shippingid."' WHERE customers_id='".$customer_id."'");
	s_redirect('confirm.php');   
}

$products_cart = cart_get_product();
if (!$products_cart) {
    s_redirect('cart.php');
}

require DIR_dzsw.'includes/user/cla.confirm.php';
$C_CONFIRM = new confirm();

$C_CONFIRM->customer_data();
$customer_data = $C_CONFIRM->customer_data;

if(!$customer_data['shipto']){
    s_redirect('address_ship.php');
}

$C_CONFIRM->shipping_data();
$shipping_data = $C_CONFIRM->shipping_data;
if(!$shipping_data['country'] && !$shipping_data['province'] && !$shipping_data['city']){
    s_redirect('address_ship.php');
}

$C_CONFIRM->shipping_list_data();
$shipping_list_data = $C_CONFIRM->shipping_list_data;

$confirm_step = confirm_step($currscript);

$page_trail[] = array('title'=>$lang_shipping_method['navbar_1'],'link'=>'confirm.php');
$page_trail[] = array('title'=>$lang_shipping_method['navbar_2']);
$page_position = page_trail();
include template("shipping_method");

?>


