<?php

/*
	[dzsw] modules/shipping/commonpost.php 
*/

function expressions_commonpost($shipping_fee, $shipping_weight){
	$shipping = $shipping_fee * $shipping_weight; 
	return $shipping;
}

?>
