<?php

/*----------------------------------------------------
	[dzsw] show_payment_info.php 

----------------------------------------------------*/
define('CURRSCRIPT','show_payment_info');
require('includes/global.php');

require DIR_dzsw.'languages/show_payment_info.php';

if (!$customer_id){
	s_redirect('login.php?direct_referer='.rawurlencode('show_payment_info.php'));
}

$C_ORDER = new order($orders_id);
$_array_o = array(
	'customer_id'	=> $customer_id,
);
$allow_ctolook = $C_ORDER->allow_ctolook($_array_o);

if($allow_ctolook){   

	$pay_detail = $C_ORDER->show_payment_info();
}

$confirm_step = confirm_step($currscript);

$page_trail[] = array('title'=>$lang_show_payment_info['navbar']);
$page_position = page_trail();
include template("show_payment_info");

?>
