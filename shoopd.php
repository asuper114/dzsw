<?php

/*----------------------------------------------------
	[dzsw] dzsw.php 


----------------------------------------------------*/
define('CURRSCRIPT','dzsw');
require('includes/global.php');

if($act == 'clearcookie_browse'){
	if(is_array($_COOKIE['product_id'])){
		foreach($_COOKIE['product_id'] as $k=>$v){
			setcookie("product_id[".$k."]", false, $timestamp - 3600);
		}
	}

	$url_forward = $_SERVER[HTTP_REFERER];	s_redirect('showmessage.php?type=dzsw_clearcookie_browse&direct_referer='.rawurlencode($url_forward));
	exit;

}elseif($act == 'clearcookie_search'){
	if(is_array($_COOKIE['search']['k'])){
		foreach($_COOKIE['search']['k'] as $k=>$v){
			setcookie("search[k][$k]", false, $timestamp - 3600);
			setcookie("search[words][$k]", false, $timestamp - 3600);
		}
	}

	$url_forward = $_SERVER[HTTP_REFERER];	s_redirect('showmessage.php?type=dzsw_clearcookie_search&direct_referer='.rawurlencode($url_forward));
	exit;

}elseif($act == 'logoff'){
	cart_empty_cart();

	$_SESSION['customer_id'] = '';
	$_SESSION['groupid'] = '';

	$url_forward = $_SERVER[HTTP_REFERER];
	s_redirect('showmessage.php?type=logoff_success&direct_referer='.rawurlencode($url_forward)); 

}else{
	exit("Undifined action");

}



?>
