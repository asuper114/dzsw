<?php

/*--------------------------------------------------------------
	[dzsw] includes/user/cla.confirm.php 

--------------------------------------------------------------*/

class confirm{
	
	var $db						= '';
	var $products_data			= '';
	var $customer_data			= '';
	var $shipping_data			= '';
	var $billing_data			= '';
	var $order_total_data		= '';

	var $products_total			= '';
	var $products_weight		= '';
	var $shipping_cost			= '';
	var $shipping_list_data		= '';

	var $insert_order_id		= '';

	var $check_stock			= '';

	function confirm(){
		global $db;
		$this->db = $db;
	}

	function products_data($reget = ''){
		global $products_cart, $table_pre, $settings;
		if (!$products_cart) {
			$products_cart = cart_get_product();
			if (!is_array($products_cart)) {
				return false;
			}
		}
		if($reget == ''){
			if(is_array($this->products_data) && is_array($this->products_data['0'])){
				return true;
			}
		}
		$products_data = array();
		foreach($products_cart as $key=>$val){
			$product_data = $this->db->get_one("SELECT p.products_id,p.name,p.model,p.s_p,p.price,p.quantity,p.weight,IF(p.s_p>0,sp.s_price,NULL) AS s_price FROM ".$table_pre."products  AS p left join ".$table_pre."specials AS sp ON p.products_id=sp.pid WHERE p.products_id = '".$key."'");
			$product_price = s_price($product_data);
			$product_data['price_array'] = $product_price;
			$product_data['final_price'] = $product_price['two']['value'];
			$product_data['price_total'] = $product_price['two']['value']*$val['quantity'];
			$product_data['price_total_text'] = display_price($product_data['price_total']);
			$product_data['buy_quantity'] = $val['quantity'];

			$this->check_stock = true;
			if ($settings['stock_check'] == 'true') {
				$stock_left = $product_data['quantity'] - $val['quantity'];
				if ($stock_left < 0) {
					$this->check_stock = false;
					if(defined('CURRSCRIPT') && CURRSCRIPT == 'cart'){
						$product_data['stock_limitsign'] = $settings['stock_limitsign'];
					}
				}
			}

			$products_data[] = $product_data;
		}

		$this->products_data = $products_data;
	}

	function products_email($reget = ''){
		$this->products_data();
		$products_email = '';
		if(is_array($this->products_data)){
			foreach($this->products_data as $key=>$val){
				$products_email .= "<tr bgcolor=\"#FFFFFF\"><td>".$val['name']."</td><td>".display_price($product_price['two']['value'])."</td><td>".$val['quantity']."</td><td>".display_price($small_total)."</td></tr>";
			}
		}
		return $products_email;
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

	function shipping_data($reget = ''){
		global $table_pre;
		if($reget == ''){
			if(is_array($this->shipping_data) && $this->shipping_data['abid']){
				return true;
			}
		}		
		$this->customer_data();
		$this->shipping_data = $this->db->get_one("SELECT * FROM ".$table_pre."address_book WHERE abid='".$this->customer_data['shipto']."'");
	}

	function billing_data($reget = ''){
		global $table_pre;
		if($reget == ''){
			if(is_array($this->billing_data) && $this->billing_data['abid']){
				return true;
			}
		}		
		$this->customer_data();
		if($this->customer_data['deli_s_bill'] == '1'){
			return true;
		}
		$this->billing_data = $this->db->get_one("SELECT * FROM ".$table_pre."address_book WHERE abid='".$this->customer_data['billto']."'");
	}

	function products_total($reget = ''){
		$this->products_data();
		if(!is_array($this->products_data)){
			return false;
		}
		if($reget == ''){
			if($this->products_total != ''){
				return true;
			}
		}	
		$price_total = 0;
		foreach($this->products_data as $k=>$v){
			$price_total += $v['price_total'];
		}
		$this->products_total = $price_total;
	}

	function products_weight($reget = ''){
		$this->products_data();
		if(!is_array($this->products_data)){
			return false;
		}
		if($reget == ''){
			if($this->products_weight != ''){
				return true;
			}
		}	
		$weight_total = 0;
		foreach($this->products_data as $k=>$v){
			$weight_total += $v['weight'];
		}
		$this->products_weight = $weight_total;
	}

	function shipping_cost($reget = ''){
		global $table_pre;
		if($reget == ''){
			if($this->shipping_cost != ''){
				return true;
			}
		}	
		$this->shipping_list_data();
		$shipping_show_data = $this->shipping_list_data;
		$this->customer_data();
		$this->shipping_cost = $shipping_show_data[$this->customer_data['shipping_method']]['money_value'];
	}

	function shipping_list_data($reget = ''){
		global $table_pre;
		if($reget == ''){
			if($this->shipping_list_data != ''){
				return true;
			}
		}	
		$this->shipping_data();
		$this->products_weight();
		$_array_ = array(
			'address_data'			=> $this->shipping_data,
			'products_weight'		=> $this->products_weight,
		);
		$this->shipping_list_data = shipping($_array_);
	}

	function order_total_data($reget = ''){
		if($reget == ''){
			if(is_array($this->order_total_data)){
				return true;
			}
		}			
		$this->products_total();
		$this->shipping_cost();
		$this->customer_data();
		$total_array = array(
			'product'		=> $this->products_total,
			'shipping'		=> $this->shipping_cost,
			'leavermoney'	=> $this->customer_data['money'],
		);
		$this->order_total_data = order_total($total_array);
	}

	function order_total_email($reget = ''){
		$this->order_total_data();
		if(is_array($this->order_total_data)){
			return false;
		}
		$order_total_email = '';
		foreach($this->order_total_data as $key=>$val){	
			$order_total_email .= "<tr><td align=\"right\">".$val['title']."</td><td>".$val['money_text']."</td></tr>";
		}
		return $order_total_email;
	}

	function check_shipping(){
		global $table_pre;
		$this->customer_data();
		if($this->customer_data['shipping_method'] == ''){
			return false;
		}

		$this->shipping_list_data();
		$shipping_show_data = $this->shipping_list_data;
		if($shipping_show_data[$this->customer_data['shipping_method']]['shippingid'] == ''){
			$this->db->query("UPDATE ".$table_pre."customers SET shipping_method='' WHERE customers_id='".$this->customer_data['customer_id']."'");
			return false;
		}		
		return true;
	}

	function check_payment(){
		global $cache_payment, $cache_shipping, $table_pre;
		$this->customer_data();
		$customer_data = $this->customer_data;
		if(!$customer_data['payment_method']){
			return false;
		}

		if(!is_array($cache_payment)){
			include_once(cacheexists('payment'));
		}
		if(!is_array($cache_shipping)){
			include_once(cacheexists('shipping'));
		}
		if($cache_payment[$customer_data['payment_method']]['pay_key'] == 'goodsarrivepay' && $cache_shipping[$customer_data['shipping_method']]['filename'] != 'goodsself'){
			$this->db->query("UPDATE ".$table_pre."customers set payment_method='' WHERE customers_id='".$this->customer_data['customer_id']."'");
			return false;
		}
		return true;
	}

	function check_stock(){
		global $settings;
		if($settings['stock_check'] != 'true') {
			return true;
		}
		$this->products_data();
		if(!is_array($this->products_data)){
			return true;
		}
		return $this->check_stock;
	}

	function insert_order_total(){
		global $table_pre, $customer_id, $settings;

		$this->order_total_data();
		if(!is_array($this->order_total_data)){
			return false;
		}
		$this->insert_order();
		foreach($this->order_total_data as $key=>$val){
			$sql_data_array = array(
				'orders_id'		=> $this->insert_order_id,
				'value'			=> $val['money_value'], 
				'classes'		=> $key
			);                   
			$this->db->perform($table_pre."orders_total", $sql_data_array);
		}
		reset($order_total);
		if($settings['user_leavepay'] == 'true'){
			$leaverpay_value = $this->order_total_data['leaverpay']['money_value'];
		}else{
			$leaverpay_value = 0;
		}
		$sql_data_array = array(
			'orders_id'		=> $this->insert_order_id,
			'value'			=> $leaverpay_value, 
			'classes'		=> 'paid'
		);                   
		$this->db->perform($table_pre."orders_total", $sql_data_array);
		if($settings['user_leavepay'] == 'true'){
			$this->db->query("update ".$table_pre."customers set money=money-".$leaverpay_value." WHERE customers_id='".$customer_id."'");
		}

	}

	function insert_order(){
		global $customer_id, $table_pre, $timestamp;
		
		if($this->insert_order_id != ''){
			return true;
		}			

		$this->customer_data();
		$this->shipping_data();
		$this->billing_data();
		$sql_data_array = array(
			'cid'				=> $customer_id,
			'c_email'			=> $this->customer_data['email'],
			'd_name'			=> $this->shipping_data['name'], 
			'd_country'			=> $this->shipping_data['country'], 
			'd_province'		=> $this->shipping_data['province'], 
			'd_city'			=> $this->shipping_data['city'],
			'd_street_address'	=> $this->shipping_data['street_address'], 
			'd_postcode'		=> $this->shipping_data['postcode'], 
			'd_tel_regular'		=> $this->shipping_data['tel_regular'], 
			'd_tel_mobile'		=> $this->shipping_data['tel_mobile'], 

			'deli_s_bill'		=> $this->customer_data['deli_s_bill'], 
														
			'payment_method'	=> $this->customer_data['payment_method'], 
			'shipping_method'	=> $this->customer_data['shipping_method'],
			'date_purchased'	=> $timestamp,
			'last_modified'		=> $timestamp,
			'do_mark'			=> '0',
			'orders_status'		=> 'noauditing',
		);

		if(!$this->customer_data['deli_s_bill']){
			$sql_data_array2 = array(
				'b_name'			=> $this->billing_data['name'], 
				'b_country'			=> $this->billing_data['country'], 
				'b_province'		=> $this->billing_data['province'], 
				'b_city'			=> $this->billing_data['city'], 
				'b_street_address'	=> $this->billing_data['street_address'], 
				'b_postcode'		=> $this->billing_data['postcode'], 
				'b_tel_regular'		=> $this->billing_data['tel_regular'], 
				'b_tel_mobile'		=> $this->billing_data['tel_mobile'],
			);
			$sql_data_array = array_merge($sql_data_array,$sql_data_array2);
		}

		$this->db->perform($table_pre."orders", $sql_data_array);
		$this->insert_order_id = $this->db->insert_id();		

	}

	function insert_history(){
		global $table_pre, $timestamp;
		$this->insert_order();
		$sql_data_array = array(
			'orders_id'			=> $this->insert_order_id, 
			'orders_status'		=> 'noauditing', 
			'date_added'		=> $timestamp
		);
		$this->db->perform($table_pre."orders_history", $sql_data_array);
	}

	function insert_products(){
		global $settings, $table_pre, $timestamp;
		$this->products_data();
		if(!is_array($this->products_data)){
			return false;
		}

		$this->insert_order();
		foreach($this->products_data as $key=>$val){
			$update_and = '';
			if($settings['stock_check'] == 'true'){
				$update_and .= " quantity = quantity-".$val['buy_quantity'];
				if($val['buy_quantity'] >= $val['quantity']){
					$update_and .= " ,available = '0' ";
				}
			}
			$this->db->query("UPDATE ".$table_pre."products SET ordered = ordered + " .$val['buy_quantity']. " ".$update_and." WHERE products_id = '".$val['products_id']."'",'ub');
			$sql_data_array = array(  
				'orders_id'			=> $this->insert_order_id, 
				'products_id'		=> $val['products_id'], 
				'model'				=> $val['model'], 
				'name'				=> $val['name'], 
				'price'				=> $val['price'], 
				'quantity'			=> $val['buy_quantity'],
				'final_price'		=> $val['final_price'],
			);

			$this->db->perform($table_pre."orders_products", $sql_data_array);
		}
	}


	function process_mail(){
		global $timestamp, $settings, $cache_payment, $lang_payment, $lang_process;
		if($settings['sendmail_createorder'] != 'true'){
			return true;
		}
		$create_date = gmdate($settings['date_format'], $timestamp+ $settings['time_ofset'] * 3600);
		$this->insert_order();
		$orders_id = $this->insert_order_id;

		if(!is_array($cache_payment)){
			include(cacheexists('payment'));
		}
		$this->customer_data();
		$payment_title = payment_title($cache_payment[$this->customer_data['payment_method']], $lang_payment);
		$products_list = $this->products_email();
		$order_total_list = $this->order_total_email();

		$emailcontents = emailcontents('order_create');
		eval("\$emailcontents = \"" .addslashes($emailcontents). "\";");
		sendmail($this->customer_data['email'],$lang_process['email_subject'],$emailcontents);
	}

}

?>
