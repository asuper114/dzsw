<?php

/*
	[dzsw] modules/shipping/chinapostems.php 
*/


function expressions_chinapostems($shipping_fee, $shipping_weight){
	$cost_table = split("[:]" , $shipping_fee); 
	if ($shipping_weight <= $cost_table[0]) 
	{ 
		$shipping = $cost_table[2]; 
	}
	else 
	{ 
		$shipping_weight_add = $shipping_weight - $cost_table[0]; 
		$mail_num=ceil($shipping_weight_add/$cost_table[1]);
		$shipping = $cost_table[2] + $mail_num * $cost_table[3]; 
	} 
	return $shipping;
}

?>
