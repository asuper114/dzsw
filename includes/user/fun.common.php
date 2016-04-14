<?php

/*----------------------------------------------------
	[dzsw] includes/user/fun.common.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

function confirm_step($currscript){
	global $lang_confirm_step;
	$confirm_step_1 = array(
		'register'					=> '0',
		'cart'						=> '1',
		'address_ship'				=> '2',
		'address_bill'				=> '2',
		'shipping_method'			=> '3',
		'payment_method'			=> '4',
		'confirm'					=> '5',
		'show_payment_info'			=> '5',
	);
	$confirm_step_2 = array(
		'0'					=> 'register',
		'1'					=> 'listincart',
		'2'					=> 'address',
		'3'					=> 'shipping',
		'4'					=> 'payment',
		'5'					=> 'confirm',
	);

	if(!is_array($lang_confirm_step)){
		return true;
	}
	$step = '';
	foreach($confirm_step_2 as $k=>$v){
		if($confirm_step_1[$currscript] >= $k){
			$step .= '<span style="color:red;">';
			$step .= $k != 0 ? '&gt;&gt; ' : '';
			$step .= $lang_confirm_step[$v].'</span>';
		}elseif($k != 0){
			$step .= '&nbsp;&nbsp;&nbsp;';
			$step .= '<i>'.$lang_confirm_step[$v].'</i>';
		}

	}

	return $step;
}

function get_hassee(){
	$hassee = '';
	if(is_array($_COOKIE['product_id'])){
		$num = 1;
		foreach($_COOKIE['product_id'] as $k=>$v){
			$hassee .= '('.$num.') <a href="product_detail.php?products_id='.$k.'">'.$v.'</a><br />';
			$num++;
		}
	}
	return $hassee;
}

function make_hassee($product_data){
	if(!$_COOKIE['product_id'][$product_data['products_id']]){
		setcookie("product_id[".$product_data['products_id']."]", $product_data['pname']);
	}
}

function marksearchhistory($s_array){
	if(!is_array($s_array)){
		return false;
	}

	$i = count($_COOKIE[search][k]);

	if($s_array['keywords'] != ''){
		if(!@in_array($s_array['keywords'], $_COOKIE[search][words])){
			$i++;
			setcookie("search[k][".$i."]", 'keywords');
			setcookie("search[words][".$i."]", $s_array['keywords']);
		}
	}
	if($s_array['manufacturer'] != ''){
		if(!@in_array($s_array['manufacturer'], $_COOKIE['search']['words'])){
			$i++;
			setcookie("search[k][".$i."]", 'manufacturer');
			setcookie("search[words][".$i."]", $s_array['manufacturer']);
		}
	}
}

function getsearchhistory(){
	$search_history = '';
	$num = 0;
	if(is_array($_COOKIE['search']['k'])){
		foreach($_COOKIE['search']['k'] as $k=>$v){
			$num ++;
			$search_history .= '('.$num.') <a href="search.php?action=search&'.$v.'='.rawurlencode($_COOKIE['search']['words'][$k]).'">'.$_COOKIE['search']['words'][$k].'</a><br />';
		}
	}
	return $search_history;
}

function stock_limitshow(){
	global $settings;

	if($settings['stock_check'] != 'true'){
		return true;
	}

	if($settings['stock_limitshow'] != 'true'){
		return false;
	}
	return true;
}

?>
