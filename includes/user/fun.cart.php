<?php

/*----------------------------------------------------
	[dzsw] includes/cart.php 

----------------------------------------------------*/
    
    
function cart_add_product($products_id){
	global $db, $table_products;
	if(cart_exists($products_id)){
		$_SESSION['cart'][$products_id]["quantity"]   = intval($_SESSION['cart'][$products_id]["quantity"])+1;
	}else{
		$products_data = $db->get_one("SELECT COUNT(*) AS count from $table_products where products_id = '" . (int)$products_id . "'");
		if($products_data['count'] > 0){
			$_SESSION['cart'][$products_id]["quantity"] = 1;
		}
	}
}

function cart_exists($id){
	if(!function_exists('array_key_exists')) {
		function array_key_exists($id,$soobic) {
			return key_exists($id,$soobic);
		}
	}
	if($_SESSION['cart'][$id] && @array_key_exists($id,$_SESSION['cart'])){
		return true;
	}else{
		return false;
	}
}

function cart_mod_product($id,$quantity){
	$arr = cart_get_product($id);
	if(cart_exists($id)){
		if($quantity < 1){
			cart_empty_cart($id);
		}else{
			$_SESSION['cart'][$id]['quantity']   = intval($quantity);
		}
	}
}

function cart_get_product($id = null){
	if(isset($_SESSION['cart'])){
		if($id == null){
			return $_SESSION['cart'];
		}else{
			return $_SESSION['cart'][$id];
		}	
	}
}

function cart_empty_cart($id = null){
	if($id == null){
		unset($_SESSION['cart']);
	}else{
		unset($_SESSION['cart'][$id]);
	}
}
    
function cart_get_weight(){   
	global $db, $table_products;
	$total = 0;
	if(is_array($_SESSION['cart']) && $_SESSION['cart']['0']) {
		foreach($_SESSION['cart'] as $key=>$val){
			$products_data = $db->get_one("select weight from $table_products where products_id = '" . (int)$key . "'");
			$total += (floatval($products_data['weight'])*intval($val['quantity']));
		}
	}
	return $total;
}

?>