<?php

/*----------------------------------------------------
	[dzsw] cart.php 

----------------------------------------------------*/
define('CURRSCRIPT','cart');
require("includes/global.php");

require DIR_dzsw.'languages/cart.php';

if($action){
	switch($action) {
		case 'update' : 
			for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {
				if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
					cart_empty_cart($_POST['products_id'][$i]);
				} else {
					cart_mod_product($_POST['products_id'][$i], $_POST['cart_quantity'][$i]);
				}
			}
		break;
		case 'add' :    
		    if ($products_id && is_numeric($products_id)){
				cart_add_product($products_id);
			}
		break;
		case 'delete' :    
		    if ($products_id && is_numeric($products_id)){
				cart_empty_cart($products_id);
			}
		break;
	}
	s_redirect('cart.php');
}

/*
if ($products_list = cart_get_product()) {

    $info_box_contents = array();
	$i = $total = $any_out_of_stock = 0;
    foreach($products_list as $key=>$val){
		$query_data = $db->get_one("select * from $table_products where products_id='".$key."' limit 1");
		if($query_data['products_id'] != ''){
			$info_box_contents[$i]['products_id'] = $key;
			$info_box_contents[$i]['quantity'] = $val['quantity'];
			$info_box_contents[$i]['name'] = $query_data['name'];
			$info_box_contents[$i]['model'] = $query_data['model'];
			$info_box_contents[$i]['image'] = $query_data['image'];

			$info_box_contents[$i]['price'] = s_price($query_data);
			$info_box_contents[$i]['total'] = display_price( $val['quantity'] * $info_box_contents[$i]['price']['two']['value']);
			$total += ($val['quantity'] * $info_box_contents[$i]['price']['two']['value']);

			if ($settings['stock_check'] == 'true') {
				 $stock_left = $query_data['quantity'] - $val['quantity'];
				 if ($stock_left < 0) {
					 $any_out_of_stock = 1;
					 $info_box_contents[$i]['stock_check'] = $settings['stock_limitsign'];
				 }
			}
			$i++;
		}
	}
	
	$cart_sum = display_price($total);
}

if ($any_out_of_stock) {
	$message_all[] = $lang_cart['stock_error'];
}
*/
require DIR_dzsw.'includes/user/cla.confirm.php';
$C_CART = new confirm();

$C_CART->products_data();
$info_box_contents = $C_CART->products_data;

$check_stock = $C_CART->check_stock();
if($check_stock == false){
	$message_all[] = $lang_cart['stock_error'];
}

$C_CART->products_total();
$cart_sum = display_price($C_CART->products_total);


$confirm_step = confirm_step($currscript);

$page_trail[] = array('title' => $lang_cart['navbar']);
$page_position = page_trail();
include template("cart");


?>

