<?php
/*----------------------------------------------------
	[dzsw] process.php 

----------------------------------------------------*/

define('CURRSCRIPT','process');

require 'includes/global.php';
require DIR_dzsw.'languages/process.php';	
	
if (!$customer_id || $customer_id=='') {
	s_redirect('login.php?direct_referer='.rawurlencode('process.php'));
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

$C_CONFIRM->insert_order();
$C_CONFIRM->insert_history();
$C_CONFIRM->insert_products();
$C_CONFIRM->insert_order_total();

if($settings['sendmail_createorder'] == 'true'){
	$C_CONFIRM->process_mail();
}

$C_CONFIRM->insert_order();
cart_empty_cart();
s_redirect('show_payment_info.php?orders_id='.$C_CONFIRM->insert_order_id);

?>
