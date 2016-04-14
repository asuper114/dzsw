<?php

/*----------------------------------------------------
	[dzsw] myaccount/order.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if($action == 'cancel'){

	$orders_id		= order_id_empty($orders_id);

	$C_ORDER = new order($orders_id);
	$order_data = $C_ORDER->__get('order_data');
	if($order_data['cid'] != $customer_id){
		s_redirect('showmessage.php?type=myaccount_order_isnotyou&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}
	if($order_data['order_status'] == 'cancel'){
		s_redirect('showmessage.php?type=myaccount_order_iscancel&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}

	$C_ORDER->order_total();
	$_array_ = array(
		'by_who'		=> 'customer',
	);	
	$allow_cancel = $C_ORDER->order_allow_cancel($_array_);
	if($allow_cancel == false){	
		s_redirect('showmessage.php?type=myaccount_order_cannotcancel&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}

	$_array_ = array(
		'operator'		=> 'c_',
	);
	$C_ORDER->order_cancel($_array_);
	s_redirect('showmessage.php?type=myaccount_order_cancelsuccess&direct_referer='.rawurlencode("myaccount.php?type=order"));
	exit;

}elseif($action == 'cpayment'){
	
	$orders_id			= order_id_empty($orders_id);

	$C_ORDER = new order($orders_id);
	$order_data = $C_ORDER->__get('order_data');
	if($order_data['cid'] != $customer_id){
		s_redirect('showmessage.php?type=myaccount_order_isnotyou&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}

	$C_ORDER->order_total();
	$allow_cpayment = $C_ORDER->order_allow_cpayment();

	if($allow_cpayment == false){
		s_redirect('showmessage.php?type=myaccount_order_cannotcpayment&direct_referer='.rawurlencode("myaccount.php?type=order&act=detail&orders_id=".$orders_id));
		exit;
	}

	include(cacheexists('shipping'));
	if($cache_shipping[$order_data['shipping_method']]['filename'] == 'goodsself'){
		$allow_goodsarrivepay = true;
	}else{
		$allow_goodsarrivepay = false;
	}

	if($_POST['payment']){
		$db->query("update $table_orders set payment_method='".$_POST['payment']."' WHERE orders_id='$orders_id'");
		s_redirect('showmessage.php?type=myaccount_order_cpaymentsuccess&direct_referer='.rawurlencode("myaccount.php?type=order&act=detail&&orders_id=".$orders_id));
		exit;
	}else{

		require DIR_dzsw.'includes/user/cla.payment.php';
		$C_PAYMENT = new payment();

		$C_PAYMENT->payment_list_data();
		$payment_data = $C_PAYMENT->payment_list_data;

		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['controlboard'],
			'link'		=> 'myaccount.php',
		);
		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['orders'],
			'link'		=> 'myaccount.php?type=order',
		);
		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['orders_detail'],
			'link'		=> 'myaccount.php?type=order&act=detail&orders_id='.$orders_id,
		);
		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['orders_spayment'],
		);
		$page_position = page_trail();
		include template("myaccount_order_spayment");
	}
	
}elseif($action == 'caddress' || $action == 'update_d' || $action == 'update_b'){
	$orders_id		= order_id_empty($orders_id);

	$C_ORDER = new order($orders_id);
	$order_data = $C_ORDER->__get('order_data');
	if($order_data['cid'] != $customer_id){
		s_redirect('showmessage.php?type=myaccount_order_isnotyou&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}

	$allow_caddress = $C_ORDER->order_allow_caddress();
	if($allow_caddress == false){
		s_redirect('showmessage.php?type=myaccount_order_noallow_caddress&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}
	$continue_do = false;
	$message_all_d = $message_all_b = array();
	if($action == 'update_d'){
		$continue_do = true;

		if (strlen($d_street_address) < 1 ) {
			$continue_do = false;
			$message_all_d[] = $lang_myaccount_order_msg['street_address'];
		}
		if (strlen($d_name) < 1) {
			$continue_do = false;
			$message_all_d[] = $lang_myaccount_order_msg['name'];
		}
		if (strlen($d_postcode) < 1) {
			$continue_do = false;
			$message_all_d[] = $lang_myaccount_order_msg['postcode'];
		}

		if ((strlen($d_tel_regular) < 1) && (strlen($d_tel_mobile) < 1)) {
			$continue_do = false;
			$message_all_d[] = $lang_myaccount_order_msg['telphone'];
		}
		if($continue_do == true){	
			$sql_data_array = array(        
				'd_name'				=> $d_name,
				'd_street_address'		=> $d_street_address,
				'd_postcode'			=> $d_postcode,
				'd_tel_regular'			=> $d_tel_regular,
				'd_tel_mobile'			=> $d_tel_mobile,
			);
			$db->perform($table_orders, $sql_data_array,'update'," orders_id='".$orders_id."'" );
		}
	}elseif($action == 'update_b'){
		$continue_do = true;

		if (strlen($b_street_address) < 1 ) {
			$continue_do = false;
			$message_all_b[] = $lang_myaccount_order_msg['street_address'];
		}
		if (strlen($b_name) < 1) {
			$continue_do = false;
			$message_all_b[] = $lang_myaccount_order_msg['name'];
		}
		if (strlen($b_postcode) < 1) {
			$continue_do = false;
			$message_all_b[] = $lang_myaccount_order_msg['postcode'];
		}
		if ((strlen($b_tel_regular) < 1) && (strlen($b_tel_mobile) < 1)) {
			$continue_do = false;
			$message_all_b[] = $lang_myaccount_order_msg['telphone'];
		}
		if($continue_do == true){
			$sql_data_array = array(        
				'b_name'				=> $b_name,
				'b_street_address'		=> $b_street_address,
				'b_postcode'			=> $b_postcode,
				'b_tel_regular'			=> $b_tel_regular,
				'b_tel_mobile'			=> $b_tel_mobile,
			);
			$db->perform($table_orders, $sql_data_array,'update'," orders_id='".$orders_id."'" );
		}
	}

	if($continue_do == true){			
		s_redirect('showmessage.php?type=myaccount_order_update_success&direct_referer='.rawurlencode("myaccount.php?type=order&act=detail&orders_id=".$orders_id));
		exit;
	}else{
		$action = 'caddress';
	}

	if($action == 'caddress'){
		if($settings['show_country'] == 'true'){
			$show_country = true;
		}
		include(cacheexists('area'));
		$shipping_data['country']	= $cache_area[$order_data['d_country']]['name'];
		$shipping_data['province']	= $cache_area[$order_data['d_province']]['name'];
		$shipping_data['city']		= $cache_area[$order_data['d_city']]['name'];
		
		if(!$order_data['deli_s_bill']){
			$bill_data['country']	= $cache_area[$order_data['b_country']]['name'];
			$bill_data['province']	= $cache_area[$order_data['b_province']]['name'];
			$bill_data['city']		= $cache_area[$order_data['b_city']]['name'];		
		}	
		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['controlboard'],
			'link'		=> 'myaccount.php'
		);
		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['orders'],
			'link'		=> 'myaccount.php?type=order'
		);
		$page_trail[] = array(
			'title'		=> $orders_id.$lang_myaccount_navbar['orders_nummberorder'],
			'link'		=> 'myaccount.php?type=order&act=detail&orders_id='.$orders_id,
		);
		$page_trail[] = array(
			'title'		=> $lang_myaccount_navbar['orders_caddress'],
		);
		$page_position = page_trail();
		include template("myaccount_order_caddress");
	}
}

if($act == 'detail'){
	$orders_id		= order_id_empty($orders_id);
	$C_ORDER = new order($orders_id);
	$order_data = $C_ORDER->__get('order_data');
	if($order_data['cid'] != $customer_id){
		s_redirect('showmessage.php?type=myaccount_order_isnotyou&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
	}
	if($settings['show_country'] == 'true'){
		$show_country = true;
	}

	$C_ORDER->order_product();
	$order_products = $C_ORDER->order_product;

	$C_ORDER->order_total();
	$order_totallist = $C_ORDER->order_total;
	$order_history = $C_ORDER->order_history();
	$order_detail = $C_ORDER->order_detail();

	$allow_cpayment = $C_ORDER->order_allow_cpayment();

	$pay_detail = $C_ORDER->show_payment_info();

	$page_trail[] = array(
		'title'		=> $lang_myaccount_navbar['controlboard'],
		'link'		=> 'myaccount.php'
	);
	$page_trail[] = array(
		'title'		=> $lang_myaccount_navbar['orders'],
		'link'		=> 'myaccount.php?type=order'
	);
	$page_trail[] = array(
		'title'		=> $lang_myaccount_navbar['orders_detail'],
	);
	$page_position = page_trail();
	include template("myaccount_order_detail");

}
		   
$query_pam = '';
if($pam == 'cancel'){
	$query_pam = " and orders_status='cancel' "; 
	$link_pam = "&pam=".$pam;
}elseif($pam=='noauditing'){
	$query_pam = " and orders_status='noauditing' ";  
	$link_pam = "&pam=".$pam;
}

$num_a_page = '20';
$page = $page ? $page : "1";
$startlimit = ($page-1)*$num_a_page;

$order_data = $db->get_one("select count(*) as count from $table_orders where cid = '" . (int)$customer_id . "' $query_pam order by orders_id DESC");
$multipage = s_multi($order_data['count'], $num_a_page, $page,'myaccount.php?type=order'.$link_pam);
$order_data = $db->query("select orders_id, orders_status, date_purchased, comment, payment_method from $table_orders where cid = '" . (int)$customer_id . "' $query_pam order by last_modified DESC, orders_id DESC limit $startlimit,$num_a_page");

include DIR_dzsw.'includes/ordersstatus.php';
$order_array = array();
while($order = $db->fetch_array($order_data)){
	$product_data = $db->query("select name,products_id from $table_orders_products where orders_id = '" . (int)$order['orders_id'] . "'");
	$products_array = array();
	while($products = $db->fetch_array($product_data)){
		$products_array[] = $products;
	}
	$order['products'] = $products_array;
	$order['order_total'] = display_price($order['order_total']);
	$order['date_purchased'] = $order['date_purchased'] ? gmdate($settings['date_format'], $order['date_purchased'] + $settings['time_ofset'] * 3600) : "";
	$order['showopration'] = 0;
	if($order['orders_status'] == 'noauditing' || ($order['orders_status']=='waitforpay' && $order['payment_method']=='goodsarrivepay')){
		$order['showcancel'] = 1;
	}
	$order['orders_status'] = $orders_status_array[$order['orders_status']]['title'];
	
	$order_array[] = $order;
}

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link'=>'myaccount.php');
$page_trail[] = array('title'=>$lang_myaccount_navbar['orders']);
$page_position = page_trail();
include template("myaccount_order_list");


function order_id_empty($orders_id){
	if(!$orders_id){	
		s_redirect('showmessage.php?type=myaccount_order_id_empty&direct_referer='.rawurlencode("myaccount.php?type=order"));
		exit;
    }else{
		return (int)$orders_id;
	}
}

?>