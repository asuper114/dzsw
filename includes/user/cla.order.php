<?php

/*--------------------------------------------------------------
	[dzsw] includes/order.class.php 

--------------------------------------------------------------*/

include DIR_dzsw.'includes/cla.order_p.php';

class order extends order_p{
	
	var $orders_id			= '';

	function order($orders_id){
		global $db;
		$this->orders_id = $orders_id;
		$this->order_data();
	}

	/*
	$_array_ = array(
		'by_who'		=> 'admin/customer',
	);
	*/	
	function order_allow_cancel($_array_ = ''){
		global $db, $cache_payment, $lang_a_order;
		
		$order_data = $this->order_data;
		$allow_cancel = false;
		if($_array_['by_who'] == 'customer'){
			$allow_cancel = true;
			if(!is_array($cache_payment)){
				include(cacheexists('payment'));
			}
			$payment_key = $cache_payment[$order_data['payment_method']]['pay_key'];
			if($payment_key == 'goodsarrivepay'){
				if($order_data['orders_status'] != 'noauditing'){
					$allow_cancel = false;
				}
			}else{
				if($order_data['orders_status'] == 'noauditing' || $order_data['orders_status'] == 'auditing' || $order_data['orders_status'] == 'waitforpay'){
					$allow_cancel = true;
				}else{
					$allow_cancel = false;
				}
			}
			if($this->get_paid > 0){
				$allow_cancel = false;
			}
		}else{
			if($order_data[orders_status] == 'noauditing' || $order_data[orders_status] == 'auditing'|| $order_data[orders_status] == 'waitforpay'|| $order_data[orders_status] == 'partpay'|| $order_data[orders_status] == 'allpay'){
				$allow_cancel = true;
			}
		}

		return $allow_cancel;
	}

	function order_allow_cpayment($_array_s = ''){
		$allow_cpayment = true;
		if($this->get_total <= $this->get_paid){
			return false;
		}

		$this->payment_key();
		$payment_key = $this->payment_key;
		if($payment_key == 'googsarrivepay'){
			if($this->order_data['orders_status'] == 'noauditing'){
			}else{
				return false;
			}
		}else{
			if($this->order_data['orders_status']	==	'noauditing'|| $this->order_data['orders_status'] == 'waitforpay' || $this->order_data['orders_status'] == 'partpay'){
			}else{
				return false;
			}
		}
		return $allow_cpayment;
	}
	
	function order_allow_caddress(){
		global $settings;

		$allowcaddress = false;
		$this->payment_key();
		$payment_key = $this->payment_key;
		if($payment_key == 'goodsarrivepay'){
			if($this->order_data['orders_status'] == 'noauditing'){
				$allowcaddress = true;
			}
		}else{
			if($this->order_data['orders_status'] == 'noauditing'){
				$allowcaddress = true;
			}elseif($this->order_data['orders_status'] == 'waitforpay' || ($this->order_data['orders_status'] == 'partpay' && $settings['user_leavepay'] == 'true')){
				$allowcaddress = true;
			}
		}
		return $allowcaddress;
	}

	/*
	$_array_o = array(
		'customer_id'	=> '',
	);
	*/
	function allow_ctolook($_array_o = ''){
		$order_data = $this->order_data;
		if($order_data['cid'] != $_array_o['customer_id']){
			return false;
		}
		return true;
	}
	function payment_type(){
		global $cache_payment;
		$order_data = $this->order_data;
		if(!is_array($cache_payment)){
			include(cacheexists("payment"));
		}
		$payment_parentid = $cache_payment[$order_data['payment_method']]['parentid'];
		if($payment_parentid != '0'){	
			$payment_type = $cache_payment[$payment_parentid]['pay_key'];
		}else{
			$payment_type = $cache_payment[$order_data['payment_method']]['pay_key'];
		}
		return $payment_type;
	}
	function show_payment_info(){
		global $settings, $timestamp, $cache_payment_key, $cache_payment, $lang_payment, $lang_payment_a, $lang_common;
		$payment_type = $this->payment_type();
		$order_data = $this->order_data;

		$this->order_total();
		$pay_total = $this->get_total-$this->get_paid;	

		if($payment_type == 'online'){
			if(!is_array($cache_payment)){
				include(cacheexists("payment"));
			}			
			include DIR_dzsw.'modules/payment/'.$cache_payment[$this->order_data['payment_method']][pay_key].'_form.php';
			$form_info['submit_name'] = $this->payment_title();
			$pay_detail = $form_info;
			$pay_detail['payment_desc'] = $lang_common['online_payment_desc'];

		}elseif($payment_type == 'postpay'){
			if(!is_array($cache_payment_key)){
				include(cacheexists("payment_key"));
			}
			$pay_detail = payment_a_title($cache_payment_key['postpay'],$lang_payment_a);
			$pay_detail['payment_desc'] = $lang_common['postremit_desc'];

		}elseif($payment_type == 'banktransfer'){
			$pay_detail = payment_a_title($cache_payment[$this->order_data['payment_method']],$lang_payment_a);
			$pay_detail['bankname'] = payment_title($cache_payment[$this->order_data['payment_method']],$lang_payment); 
			$pay_detail['payment_desc'] = $lang_common['banktransfer_desc'];

		}elseif($payment_type == 'goodsarrivepay'){
			$pay_detail['payment_desc'] = $lang_common['goodsarrive_desc'];

		}

		$pay_detail['orders_id'] = $order_data['orders_id'];
		$pay_detail['payment_type'] = $payment_type;
		$pay_detail['payment_title'] = $this->payment_title();
		$pay_detail['pay_total_text'] = display_price($pay_total);

		return $pay_detail;
	}

}

?>
