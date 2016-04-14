<?php

/*
	[dzsw] modules/shipping/quick.php 

*/

function expressions_quick($shipping_fee, $shipping_weight){
	
	$cost_table = split("[:]" , $shipping_fee); 
	if ($shipping_weight <= $cost_table[0]) { 
		$shipping = $cost_table[3]; 
	}else{
		if ($shipping_weight > $cost_table[0]){ 
			if ($shipping_weight <= $cost_table[1]){ 
				$shipping_weight_add = $shipping_weight - $cost_table[0]; 
			}else{
				$shipping_weight_add = $cost_table[1] - $cost_table[0]; 
			}
			$mail_num = ceil($shipping_weight_add/$cost_table[2]);
			$shipping = $cost_table[3] + $mail_num * $cost_table[4]; 
		} 
		if($shipping_weight > $cost_table[1]){ 
			$shipping_weight_add = $shipping_weight - $cost_table[1]; 
			$mail_num = ceil($shipping_weight_add/$cost_table[2]);
			$shipping = $shipping + $mail_num * $cost_table[5]; 
		}
	} 
	return $shipping;

}

?>
