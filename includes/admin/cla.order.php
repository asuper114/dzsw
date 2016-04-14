<?php

/*--------------------------------------------------------------

	[dzsw] includes/order.class.php 

--------------------------------------------------------------*/

include DIR_dzsw.'includes/cla.order_p.php';

class order extends order_p{
	
	var $orders_id			= '';
	var $payback_data		= '';
	var $payback_message	= '';

	function order($orders_id){
		global $db;
		$this->orders_id = $orders_id;
		$this->order_data();
	}

	function operate_status(){
		global $allow_orderstatus, $allow_orderstatus_g;

		$this->orders_status_array();
		
		$operate_orderstatus = array();
		$this->payment_key();
		if($this->payment_key == 'goodsarrivepay'){
			$operate_orderstatus = @array_intersect($this->orders_status_array[$this->order_data['orders_status']]['show'], explode(',',$allow_orderstatus_g));
			//array_unshift ($operate_orderstatus, $this->order_data['orders_status']);
		}else{
			$operate_orderstatus = @array_intersect($this->orders_status_array[$this->order_data['orders_status']]['show'], explode(',',$allow_orderstatus));
		}  

		$order_status_show = array();
		if(count($operate_orderstatus) > 0){
			$i = 0;
			foreach($operate_orderstatus as $v){
				//$selected = $v == $this->order_data['orders_status'] ? 'selected' : '';
				if($this->order_data['orders_status'] == 'cancel'){
					$this->order_total();
					if($this->get_paid>0){
						$this->payback_message();
					}else{
						continue;
					}
				}elseif($this->order_data['orders_status'] == 'auditing'){
					if($this->payment_key != 'goodsarrivepay'){
						if($v == 'waitforpay'){
							$this->order_total();
							if($this->get_paid < $this->get_total){
							}else{
								continue;
							}							
						}elseif($v == 'shipping'){
							$this->order_total();
							if($this->get_paid < $this->get_total){
								continue;
							}
						}
					}

				}elseif($v == 'payback'){
					$this->payback_message();
				}
				$order_status_show[] = array(
					'statuskey'		=> $v,
					'title'			=> $this->orders_status_array[$v]['title'],
					'selected'		=> $i == 0 ? 'selected' : '',
				);
				$i++;
			}
		}
		return $order_status_show;
	}

	function allow_addmoney(){
		global $allow_orderstatus, $allow_orderstatus_g;
		$allow_addmoney = false;
		$this->payment_key();
		if($this->payment_key == 'goodsarrivepay'){
		}else{
			if($this->order_data['orders_status'] == 'waitforpay' || $this->order_data['orders_status'] == 'partpay'){
				$allow_addmoney = true;
			}
			if($allow_addmoney == true){
				if(!in_array($this->order_data['orders_status'],explode(',',$allow_orderstatus))){
					$allow_addmoney = false;
				}
			}
		}

		return $allow_addmoney;
	}

	function allow_print(){
		global $adminid, $allow_order_see;
		if($adminid == '1'){
			return true;
		}
		if(!$allow_order_see){
			return false;
		}
		return true;
	}

	function dopayback(){
		global $settings, $timestamp, $table_pre, $adminid;
		$this->order_total();
		if($this->get_paid > 0){
		}else{
			return true;
		}
		if($settings['user_leavepay'] == 'true'){
			$this->payback_data();	
			if($this->payback_data['payreturn'] == 'myaccount'){
				$this->paybacktomyaccount();
			}elseif($this->payback_data['payreturn'] == 'choose'){
				if($this->get_paid < 5){
					$this->paybacktomyaccount();
				}
			}elseif($this->payback_data['payreturn'] == 'all'){
			}
		}
	}
	
	function paybacktomyaccount(){
		global $table_pre;
		$this->db->query("UPDATE ".$table_pre."customers SET money=money+'".$this->get_paid."' WHERE customers_id='".$this->order_data['cid']."'");
		$this->db->query("UPDATE ".$table_pre."orders_total set value='0' WHERE orders_id = '" . (int)$this->orders_id . "' AND classes='paid'");
	}

	function paybacktomyself(){
		global $table_pre, $lang_a_order;
		$this->payback_data();
		if($this->payback_data['payback'] == 'post'){
			$this->payback_message = $lang_a_order['payback_toall_bypost'];
		}else{
			$name = $this->payback_data['name'];
			$cartnum = $this->payback_data['cartnum'];
			$bankname = $this->payback_data['bankname'];
			@eval("\$lang_payback_toall_bybank = \"" .$lang_a_order['payback_toall_bybank']. "\";");
			$this->payback_message = $lang_payback_toall_bybank;
		}
	}

	function payback_message(){
		global $lang_a_order, $settings;
		$this->order_total();
		if($this->get_paid > 0){
		}else{
			return true;
		}
		if($settings['user_leavepay'] == 'true'){
			$this->payback_data();	

			if($this->payback_data['payreturn'] == 'myaccount'){
				$this->payback_message = $lang_a_order['payback_tomyaccount'];
			}elseif($this->payback_data['payreturn'] == 'choose'){
				if($this->get_paid < 5){
					$this->payback_message = $lang_a_order['payback_tomyaccount'];
				}else{	
					$this->paybacktomyself();
				}
			}elseif($this->payback_data['payreturn'] == 'all'){
				$this->paybacktomyself();
			}
		}else{
			$this->paybacktomyself();
		}
	}

	function payback_data($reget = ''){
		global $settings, $table_pre;
		if($reget == ''){
			if(is_array($this->payback_data) && $this->payback_data['id'] != ''){
				return true;
			}
		}
		$payback_data = $this->db->get_one("SELECT * FROM ".$table_pre."payback WHERE cid='".$this->order_data['cid']."'");
		$this->payback_data = $payback_data;
	}

	function order_allow_cancel(){
		global $db, $cache_payment, $lang_a_order;
		
		$order_data = $this->order_data;
		$allow_cancel = false;
		$this->payment_key();
		if($this->payment_key == 'goodsarrivepay'){
			if($order_data[orders_status] == 'noauditing' || $order_data[orders_status] == 'allsend'){
				$allow_cancel = true;
			}
		}else{
			if($order_data[orders_status] == 'noauditing' || $order_data[orders_status] == 'allsend'){
				$allow_cancel = true;
			}
		}
		return $allow_cancel;
	}
}
