<?php

/*----------------------------------------------------
	[dzsw] payment_method.php 


----------------------------------------------------*/
define('CURRSCRIPT','payment_method');
require('includes/global.php');

if (!$customer_id || $customer_id=='') {
    $referer = s_referer();
    s_redirect('login.php?direct_referer='.rawurlencode('payment_method.php'));
}

if (!cart_get_product()) {
    s_redirect('cart.php');
}
require DIR_dzsw.'languages/payment_method.php';

if(isset($_POST['payment'])) {
	$db->query("update $table_customers set payment_method='".$payment."' WHERE customers_id='".$customer_id."'");
	s_redirect('confirm.php');
}   

if(!is_array($cache_shipping)){
	include(cacheexists('shipping'));
}

require DIR_dzsw.'includes/user/cla.payment.php';
$C_PAYMENT = new payment();

$C_PAYMENT->customer_data();
$customer_data = $C_PAYMENT->customer_data;

$C_PAYMENT->payment_list_data();
$payment_list_data = $C_PAYMENT->payment_list_data;

$confirm_step = confirm_step($currscript);

$page_trail[] = array('title'=>$lang_payment_method['navbar_1'],'link'=>'confirm.php');
$page_trail[] = array('title'=>$lang_payment_method['navbar_2']);
$page_position=  page_trail();
include template("payment_method");

?>
