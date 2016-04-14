<?php

/*--------------------------------------------------------------
	[dzsw] includes/user/cla.payment.php 

--------------------------------------------------------------*/

class payment{
	
	var $db						= '';
	var $customer_data			= '';
	var $payment_list_data		= '';

	function payment(){
		global $db;
		$this->db = $db;
	}

	function customer_data($reget = ''){
		global $table_pre, $customer_id;
		if($reget == ''){
			if(is_array($this->customer_data) && $this->customer_data['email']){
				return true;
			}
		}		
		$customer_data = $this->db->get_one("SELECT email, shipto, shipping_method, billto, deli_s_bill, payment_method, comment, money FROM ".$table_pre."customers WHERE customers_id='".$customer_id."'");
		$this->customer_data = $customer_data;
	}

	function allow_goodsarrivepay(){
		global $cache_shipping;
		if(!is_array($cache_shipping)){
			include(cacheexists('shipping'));
		}		
		
		$this->customer_data();
		if($cache_shipping[$this->customer_data['shipping_method']]['filename'] == 'goodsself'){
			$allow_goodsarrivepay = true;
		}else{
			$allow_goodsarrivepay = false;
		}		
		return $allow_goodsarrivepay;
	}
	
	function payment_list_data(){
		global $lang_payment, $lang_payment_a;
		$cache_payment = $GLOBALS['cache_payment'];
		if(!is_array($cache_payment)){
			include(cacheexists('payment'));
		}

		$payment_list_data = array();
		if(is_array($cache_payment)){
			foreach($cache_payment as $key=>$val){
				if($val['status'] == '0'){
					continue;
				}
				$val['title'] = payment_title($val,$lang_payment);
				$val['pa'] = payment_a_title($val,$lang_payment_a);
				if($val['pay_key'] == 'goodsarrivepay'){
					$allow_goodsarrivepay = $this->allow_goodsarrivepay();
					if($allow_goodsarrivepay && $val['parentid'] == '0'){
						$payment_list_data[$val['pay_key']] = $val;
					}
				}elseif($val['parentid'] == '0'){
					$val['child'] = array();
					
					foreach($cache_payment as $key2=>$val2){
						if($val2['status'] == '0'){
							continue;
						}
						if($val2['parentid'] == $val['id']){
							$val2['title'] = payment_title($val2,$lang_payment);
							$val2['pa'] = payment_a_title($val2,$lang_payment_a);
							$val['child'][] = $val2;
						}
					}
					$payment_list_data[$val['pay_key']] = $val;
				}
			}
		}
		$this->payment_list_data = $payment_list_data;
	}

}

?>
