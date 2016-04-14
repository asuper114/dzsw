<?php

/*----------------------------------------------------
	[dzsw] includes/user/shipping.php 

----------------------------------------------------*/


/*
$_array_ = array(
	'address_data'			=> '',
	'shipping_weight'		=> '',
);
*/
function shipping($_array_){
	global $cache_shipping_fee, $cache_shipping, $lang_shipping;
	$shipping_weight = $_array_['products_weight'];
	$address_data = $_array_['address_data'];

	if(!$shipping_weight){
		$shipping_weight = cart_get_weight();
	}
	if(!is_array($cache_shipping_fee) || !is_array($cache_shipping)){
		include_once(cacheexists('shipping'));
	}

	$shipping_show_data_ = $shipping_show_data = array();
	$shipping_data_empty = true;
	if(is_array($cache_shipping_fee)){
		foreach($cache_shipping_fee as $key=>$val){
			$area_array = explode(',',$val['area']);
			if((in_array($address_data['city'],$area_array) || in_array($address_data['province'],$area_array) || in_array($address_data['country'],$area_array)) && $area_array['0']){
				$shipping_filename = $cache_shipping[$val['shippingid']]['filename'];
				if($shipping_filename){
					include_once DIR_dzsw.'modules/shipping/'.$shipping_filename.'.php';

					$fee_value = call_user_func_array("expressions_".$shipping_filename, array($val['fee'], $shipping_weight));
					$shipping_data_empty = false;
					if(in_array($address_data['city'],$area_array)){
						$shipping_k = 'city';
					}elseif(in_array($address_data['province'],$area_array)){
						$shipping_k = 'province';
					}elseif(in_array($address_data['country'],$area_array)){
						$shipping_k = 'country';
					}
					$shipping_show_data_[$val['shippingid']][$shipping_k] = array(
						'shippingid'		=> $val['shippingid'],
						'title'				=> $lang_shipping[$shipping_filename],
						'status'			=> $cache_shipping[$val['shippingid']]['status'],
						'description'		=> $cache_shipping[$val['shippingid']]['description'],
						'money_value'		=> $fee_value,
						'money_text'		=> display_price($fee_value)
					);
				}
			}
		}
	}

	if(is_array($shipping_show_data_)){
		
		foreach($shipping_show_data_ as $key=>$val){
			if($val['city']['shippingid']){
				$shipping_show_data[$key] = $val['city'];
			}elseif($val['province']['shippingid']){
				$shipping_show_data[$key] = $val['province'];
			}elseif($val['country']['shippingid']){
				$shipping_show_data[$key] = $val['country'];
			}
		}
		unset($shipping_show_data_);

	}

	return $shipping_show_data;
}

?>
