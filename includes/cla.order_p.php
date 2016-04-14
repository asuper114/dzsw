<?php

/*--------------------------------------------------------------
	[dzsw] includes/order.class.php 

--------------------------------------------------------------*/

class order_p{
	
	var $orders_id					= '';
	var $db							= '';
	var $order_data					= '';

	var $get_paid					= '';
	var $get_total					= '';
	var $get_shipping				= '';

	var $order_product				= '';
	var $order_total				= '';
	var $orders_status_array		= '';

	var $payment_key				= '';

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}	

	function order_data(){
		global $db, $table_orders;
		$this->db = $db;
		$order_data = $this->db->get_one("select * from $table_orders where orders_id = '" . (int)$this->orders_id . "'");
		$this->order_data = $order_data;
	}

	function order_detail($_array_ = ''){
		global $table_pre, $cache_area, $cache_payment_key, $cache_shipping, $lang_shipping, $lang_payment;
		$orders_data = $this->order_data;

		if(!is_array($cache_area)){
			include(cacheexists("area"));
		}
		$orders_data['d_country']	= $cache_area[$orders_data['d_country']]['name'];
		$orders_data['d_province']	= $cache_area[$orders_data['d_province']]['name'];
		$orders_data['d_city']		= $cache_area[$orders_data['d_city']]['name'];
		$orders_data['b_country']	= $cache_area[$orders_data['b_country']]['name'];
		$orders_data['b_province']	= $cache_area[$orders_data['b_province']]['name'];
		$orders_data['b_city']		= $cache_area[$orders_data['b_city']]['name'];

		$customer_data = $this->db->get_one("SELECT email FROM ".$table_pre."customers WHERE customers_id='".$orders_data['cid']."'");
		$orders_data['c_email'] = $customer_data['email'];

		$orders_data['deli_s_bill'] = $orders_data['deli_s_bill'];

		$this->orders_status_array();
		$orders_data['status'] = $this->orders_status_array[$orders_data['orders_status']]['title'];

		if(!is_array($cache_payment_key)){
			include(cacheexists('payment_key'));
		}
		$this->payment_key();
		$orders_data['payment_title'] = payment_title($cache_payment_key[$this->payment_key],$lang_payment);

		if(!is_array($cache_shipping)){
			include(cacheexists('shipping'));
		}
		$shipping_key = $cache_shipping[$orders_data['shipping_method']]['filename'];
		$orders_data['shipping_title'] = $lang_shipping[$shipping_key];

		return $orders_data;
	}

	function order_total($reget = ''){
		global $table_pre, $lang_order_total;
		if($reget == ''){
			if(is_array($this->order_total) && is_array($this->order_total['0'])){
				return true;
			}
		}
		$query = $this->db->query("select value,classes from ".$table_pre."orders_total  where orders_id='".$this->orders_id."'");
		$order_total_array_ = array();
		$this->order_total_show = '';
		while($order_total = $this->db->fetch_array($query)){
			if($order_total['classes'] == 'paid'){
				$this->get_paid = $order_total['value'];
			}elseif($order_total['classes'] == 'total'){
				$this->get_total = $order_total['value'];
			}elseif($order_total['classes'] == 'shipping'){
				$this->get_shipping = $order_total['value'];
			}
			$order_total['value_text'] = display_price($order_total['value']);
			$order_total['title'] = $lang_order_total[$order_total['classes']];
			
			$order_total_array_[] = $order_total;
		}	
		$this->order_total = $order_total_array_;
	}

	function order_total_email(){
		$this->order_total();
		$order_total_email = '';
		if(is_array($this->order_total)){
			foreach($this->order_total as $k=>$v){

				$order_total_email .= "<tr><td align=\"right\">".$v['title']."</td><td>".$v['value_text']."</td></tr>";
				
			}
		}
		return $order_total_email;
	}

	function payment_key($reget = ''){
		global $cache_payment;
		if($reget == ''){
			if($this->payment_key != ''){
				return true;
			}
		}
		if(!is_array($cache_payment)){
			include(cacheexists('payment'));
		}
		$this->payment_key = $cache_payment[$this->order_data['payment_method']]['pay_key'];
	}

	function payment_title(){
		global $cache_payment_key, $lang_payment;
		$this->payment_key();
		if(!is_array($cache_payment_key)){
			include(cacheexists('payment_key'));
		}
		$payment_title = payment_title($cache_payment_key[$this->payment_key],$lang_payment);
		return $payment_title;
	}

	function orders_status_array(){
		if(is_array($this->orders_status_array)){
			return true;
		}
		global $lang_orderstatus;
		$this->payment_key();
		if($this->payment_key == 'goodsarrivepay'){
			include DIR_dzsw.'includes/ordersstatus_g.php';	
		}else{
			include DIR_dzsw.'includes/ordersstatus.php';	
		}
		$this->orders_status_array = $orders_status_array;
	}

	function order_product($reget = ''){
		global $table_pre;
		if($reget == ''){
			if(is_array($this->order_product) && is_array($this->order_product['0'])){
				return true;
			}
		}
		$query = $this->db->query("select products_id,model,name,price,final_price, quantity from ".$table_pre."orders_products where orders_id='" . (int)$this->orders_id . "'");
		$products = array();
		while($query_data = $this->db->fetch_array($query)){
			$query_data['final_price_text'] = display_price($query_data['final_price']);
			$products[] = $query_data;
		}
		$this->order_product = $products;
	}

	function order_product_email(){
		$this->order_product();
		$order_product_email = '';
		if(is_array($this->order_product)){
			foreach($this->order_product as $k=>$v){		
				$small_total = display_price($v['final_price'] * $v['quantity']);
				$order_product_email .= "<tr class=\"bgcolor1\"><td>".$v['name']."</td><td>".display_price($v['final_price'])."</td><td>".$v['quantity']."</td><td>".$small_total."</td></tr>";	
			}
		}
		return $order_product_email;
	}

	function order_history(){
		global $settings, $table_pre, $cache_payment_key, $lang_payment, $lang_common, $lang_a_order;
		
		$this->orders_status_array();

		$query = $this->db->query("select * from ".$table_pre."orders_history where orders_id='" . (int)$this->orders_id . "' order by date_added");
		$orders_history_array = array();
		if(!is_array($cache_payment_key)){
			include(cacheexists("payment_key"));
		}
		while($query_data = $this->db->fetch_array($query)){
			$query_data['orders_status'] = $this->orders_status_array[$query_data['orders_status']]['title'];
			$query_data['date_added'] = $query_data['date_added'] ? gmdate($settings['date_format'].' H:i:s', $query_data['date_added']+ $settings['time_ofset'] * 3600) : "";
			if($query_data['payment_type']){
				$payment_type_array = explode('_',$query_data['payment_type']);
				$query_data['payment_title'] = payment_title($cache_payment_key[$payment_type_array['0']],$lang_payment);
			}else{
				$query_data['payment_title'] = $lang_common['no_fit'];
			}
			if($query_data['operator']){
				$operator_array = explode('_',$query_data['operator']);
				if($operator_array['0'] == 'a'){
					$admin_data = $this->db->get_one("SELECT email FROM ".$table_pre."admins WHERE adminid='".$operator_array['1']."' limit 1");
					$query_data['operator'] = $admin_data['email'];
				}elseif($operator_array['0'] == 'c'){
					$query_data['operator'] = $lang_a_order['customer_self'];
				}else{
					$query_data['operator'] = '';
				}
			}
			if($query_data['paidnum'] > 0){
				$query_data['paidnum'] = display_price($query_data['paidnum']);
			}else{
				$query_data['paidnum'] = '';
			}
			$orders_history_array[] = $query_data;	
		}
		return $orders_history_array;
	}

	/*
	$_array_ = array(
		'insert_money'		=> '',
		'payment_type'		=> '',
		'get_paid'			=> '',
		'get_total'			=> '',
		'customer_id'		=> '',
	);
	*/
	function insert_money($_array_s){
		
		global $db, $table_orders_total, $table_orders_history, $table_orders, $table_customers;	
		global $timestamp, $settings;

		if($_array_s['get_paid'] != '' && $_array_s['get_total'] != ''){
			$this->get_paid = $_array_s['get_paid'];
			$this->get_total = $_array_s['get_total'];
		}elseif($this->get_paid != '' && $this->get_total != ''){
		}else{
			$this->order_total();		
		}

		if($this->get_total > $this->get_paid){
			$sql_data_array = array(
				'orders_id'			=> $this->orders_id,
				'orders_status'		=> 'partpay',
				'date_added'		=> $timestamp,
				'paidnum'			=> $_array_s['insert_money'],
				'paid_type'			=> '+',
				'payment_type'		=> $_array_s['payment_type'],
				'operator'			=> $_array_s['operator'],
			);
			$db->perform($table_orders_history, $sql_data_array);

			$sql_data_array = array(
				'orders_status'		=> 'partpay',
				'last_modified'		=> $timestamp,
			);
			$db->perform($table_orders, $sql_data_array, 'update',"orders_id='".$this->orders_id."'");

			$db->query("update $table_orders_total set value='".($this->get_total-$this->get_paid)."' where orders_id = '" . (int)$this->orders_id. "' and classes='mustpay'");

		}elseif($this->get_total == $this->get_paid){
			$sql_data_array = array(
				'orders_id'			=> $this->orders_id,
				'orders_status'		=> 'allpay',
				'date_added'		=> $timestamp,
				'paidnum'			=> $_array_s['insert_money'],
				'paid_type'			=> '+',
				'payment_type'		=> $_array_s['payment_type'],
				'operator'			=> $_array_s['operator'],
			);
			$db->perform($table_orders_history, $sql_data_array);			

			$sql_data_array = array(
				'orders_status'		=> 'allpay',
				'last_modified'		=> $timestamp,
			);
			$db->perform($table_orders, $sql_data_array, 'update',"orders_id='".$this->orders_id."'");

			$db->query("update $table_orders_total set value='0' where orders_id = '" . (int)$this->orders_id. "' and classes='mustpay'");
		
		}elseif($this->get_total < $this->get_paid){
			$sql_data_array = array(
				'orders_id'			=> $this->orders_id,
				'orders_status'		=> 'allpay',
				'date_added'		=> $timestamp,
				'paidnum'			=> $_array_s['insert_money'],
				'paid_type'			=> '+',
				'payment_type'		=> $_array_s['payment_type'],
				'operator'			=> $_array_s['operator'],
			);
			$db->perform($table_orders_history, $sql_data_array);

			$sql_data_array = array(
				'orders_status'		=> 'allpay',
				'last_modified'		=> $timestamp,
			);
			$db->perform($table_orders, $sql_data_array, 'update',"orders_id='".$this->orders_id."'");			

			$money = ($this->get_paid-$this->get_total);
			$db->query("update $table_orders_total set value='0' where orders_id = '" . (int)$this->orders_id . "' and classes='mustpay'");
			$db->query("update $table_orders_total set value='".$this->get_total."' where orders_id = '" . (int)$this->orders_id . "' and classes='paid'");
			if($settings['user_leavepay'] == 'true'){
				if($_array_s['customer_id'] == ''){
					if($this->order_data['cid'] == ''){
						$this->order_data();
					}
					$_array_s['customer_id'] = $this->order_data['cid'];
				}
				$db->query("update $table_customers set money=money+'$money' where customers_id='".$_array_s['customer_id']."' ");
			}
		}
	}

	/*
	$_array_ = array(
		'orders_status'		=> '',
		'operator'			=> 'a_ || c_',
	);
	*/
	function update_status($_array_s){
		global $table_pre, $timestamp;
		$sql_data_array = array(
			'orders_status'		=> $_array_s['orders_status'],
			'last_modified'		=> $timestamp,
		);
		$this->db->perform($table_pre."orders", $sql_data_array, 'update',"orders_id='".$this->orders_id."'");	
		
		if($_array_s['orders_status'] == 'cancel'){
			$this->order_cancel($_array_s);
		}
		$sql_data_array = array(
			'orders_id'			=> $this->orders_id,
			'orders_status'		=> $_array_s['orders_status'],
			'date_added'		=> $timestamp,
			'operator'			=> $_array_s['operator'],
		);
		$this->db->perform($table_pre."orders_history", $sql_data_array);
	}

	/*
	$_array_ = array(
		'order_title_header'		=> '',
		'tplname'					=> '',
	);
	*/
	function email_process($_array_){
		global $settings;

		$products_list = $this->order_product_email();
		$order_total_list = $this->order_total_email();
		$create_date = gmdate($settings['date_format'], $this->order_data['date_purchased']+ $settings['time_ofset'] * 3600);
		$payment_title = $this->payment_title();
		$orders_id = $this->orders_id;
		$order_title_header = $_array_['order_title_header'];
		@eval("\$order_title_header = \"" .addslashes($_array_['order_title_header']). "\";");

		$emailcontents = emailcontents($_array_['tplname']);
		@eval("\$emailcontents = \"" .addslashes($emailcontents). "\";");
		sendmail($this->order_data['c_email'],$_array_['subject'],$emailcontents);
	}

	/*
	$_array_ = array(
		'status_insert'				=> '',
	);
	*/
	function nt_create($_array_){
		global $db, $settings, $table_customers, $table_orders;
		
		$this->order_total();
		$order_data = $this->order_data;
		$nt_credit = (is_numeric($settings['nt_tomark']) && $settings['nt_tomark']>0) ? $settings['nt_tomark'] : '10';
		$member_get_mark = @round($this->get_total/$nt_credit); 
		if($_array_['status_insert'] == 'over'){
			if($order_data['do_mark'] == '0'){
				$db->query("update $table_customers set credit=credit+'$member_get_mark' where customers_id='".$order_data['cid']."'",'ub');
				$db->query("update $table_orders set do_mark='1',last_modified='$timestamp' where orders_id = '" . (int)$this->orders_id . "'",'ub');
			}
		}elseif($_array_['status_insert'] == 'payback'){
			if($order_data['do_mark']=='1'){
				$db->query("update $table_customers set credit=credit-'$member_get_mark' where customers_id='".$order_data['cid']."'",'ub');
				$db->query("update $table_orders set do_mark='0',last_modified='$timestamp' where orders_id = '" . (int)$this->orders_id . "'",'ub');
			}
		}
	}

	/*
	$_array_s = array(
		'operator'				=> 'a_/c_',
	);
	*/
	function order_cancel($_array_s){
		global $settings, $timestamp, $table_pre;
		if($settings['stock_check'] == 'true'){
			$query = $this->db->query("SELECT products_id,quantity FROM ".$table_pre."orders_products WHERE orders_id='".(int)$this->orders_id."' ");
			while($product = $this->db->fetch_array($query)){
				if($settings['stock_limitshow'] != 'true'){
					$update_and = " , available='1' ";
				}else{
					$update_and = "";
				}
				$this->db->query("UPDATE ".$table_pre."products SET quantity=quantity+'".$product['quantity']."' $update_and WHERE products_id = '".$product['products_id']."'",'ub');
			}
		}
		$this->db->query("UPDATE ".$table_pre."orders SET orders_status='cancel' WHERE orders_id = '" . (int)$this->orders_id . "'");
		$sql_data_array = array(
			'orders_id'			=> $this->orders_id,
			'orders_status'		=> 'cancel',
			'date_added'		=> $timestamp,
			'operator'			=> $_array_s['operator'],
		);
		$this->db->perform($table_pre."orders_history", $sql_data_array);
	}
	
}
