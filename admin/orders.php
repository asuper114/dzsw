<?php

/*----------------------------------------------------
	[dzsw] admin/orders.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if(!$allow_order_see){
	admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
}

include DIR_dzsw.'includes/admin/cla.order.php';

if($action == 'update_status'){	
	$C_ORDER = new order($orders_id);

	$operate_status = $C_ORDER->operate_status();
	$show_operate = false;
	if(count($operate_status) > 0){
		$show_operate = true;
	}
	$allow_addmoney = $C_ORDER->allow_addmoney();
	if($allow_addmoney == true){
		$show_operate = false;
	}
	if(!$show_operate){
        admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
    }	

	if($orders_status_insert){
		$_array_ = array(
			'orders_status'		=> $orders_status_insert,
			'operator'			=> 'a_'.$adminid,
		);
		$C_ORDER->update_status($_array_);
	}

	if($orders_status_insert == 'payback'){
		$C_ORDER->dopayback();
	}

	$_array_ = array(
		'status_insert'		=> $orders_status_insert,
	);
	$C_ORDER->nt_create($_array_);
	if($sendmail == 1){
		$C_ORDER->orders_status_array();
		$order_title_header = $C_ORDER->orders_status_array[$orders_status_insert]['email'];
		$_array_ = array(
			'order_title_header'		=> $order_title_header,
			'subject'					=> $lang_a_order['email_subject_order'],
			'tplname'					=> 'adminorder',
		);
		$C_ORDER->email_process($_array_);
	}	
	admin_msg($lang_a_message['operate_success'],'admin.php?act=orders&type=detail&orders_id='.$orders_id);

}elseif($action == 'inset_paid'){

	$C_ORDER = new order($orders_id);
	$C_ORDER->__set('sendmail',$sendmail);

	$allow_addmoney = $C_ORDER->allow_addmoney();
	if(!$allow_addmoney){
        admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
    }
     
    if($inset_paid > 0){
		if (!ereg ("(^[0-9]{1,}(\.[0-9]{1,2})?$)",$inset_paid)){
			admin_msg($lang_a_order['msg_orderpaymustint'],'javascript:history.go(-1);','back');
        }else{
			$db->query("update $table_orders_total set value=value+".$inset_paid." where orders_id = '" . (int)$orders_id . "' and classes='paid'");
        }
	}

	if($inset_paid > 0){
		$_array_ = array(
			'insert_money'		=> $inset_paid,
			'payment_type'		=> "admin_".$orders_id,
			'operator'			=> 'a_'.$adminid,
		);
		$C_ORDER->insert_money($_array_);
	}

	if($sendmail == 1){
		$order_title_header = $lang_a_order['email_header_paid'];
		$_array_ = array(
			'order_title_header'		=> $order_title_header,
			'subject'					=> $lang_a_order['email_subject_order'],
			'tplname'					=> 'adminorder',
		);
		$C_ORDER->email_process($_array_);
	}	
	admin_msg($lang_a_message['operate_success'],'admin.php?act=orders&type=detail&orders_id='.$orders_id);

}elseif($action == 'cancel'){
	$C_ORDER = new order($orders_id);
	$allow_cancel = $C_ORDER->order_allow_cancel();	
	if(!$allow_cancel){
        admin_msg($lang_a_order['msg_ordercancelforbid'],'javascript:history.go(-1);','back');
    }

	$_array_ = array(
		'operator'				=> 'a_'.$adminid,
	);
	$C_ORDER->order_cancel($_array_);
	if($sendmail == '1'){
		$_array_ = array(
			'order_title_header'		=> $cancelwhyvalue,
			'subject'					=> $lang_a_order['email_subject_order'],
			'tplname'					=> 'order_cancel',
		);
		$C_ORDER->email_process($_array_);
	}	admin_msg($lang_a_message['operate_success'],'admin.php?act=orders&type=edit&orders_id='.$orders_id);

}

if($type == 'detail'){
    $C_ORDER = new order($orders_id);
	
	$C_ORDER->order_product();
	$order_products = $C_ORDER->order_product;
	$C_ORDER->order_total();
	$order_totallist = $C_ORDER->order_total;
	$order_history = $C_ORDER->order_history();
	$order_detail = $C_ORDER->order_detail();

	$operate_status = $C_ORDER->operate_status();
	$show_operate = false;
	if(count($operate_status) > 0){
		$show_operate = true;
	}
	$payback_message = $C_ORDER->payback_message;

	$allow_addmoney = $C_ORDER->allow_addmoney();
	if($allow_addmoney == true){
		$show_operate = false;
	}

	include ADMIN_TPL.'orders_one.htm';
	
}elseif($type == 'cancel'){   
	$C_ORDER = new order($orders_id);
	$allow_cancel = $C_ORDER->order_allow_cancel();	
	if(!$allow_cancel){
        admin_msg($lang_a_order['msg_ordercancelforbid'],'javascript:history.go(-1);','back');
    }

	$C_ORDER->order_total();
    $paid_money = display_price($C_ORDER->__get('get_paid'));
    $total_money = display_price($C_ORDER->__get('get_total'));
	
	$C_ORDER->orders_status_array();
	$orders_status_cancel = $C_ORDER->orders_status_array['cancel']['sub'];
	$orders_cancel = array();
	if(is_array($orders_status_cancel)){
		$i = 0;
		foreach($orders_status_cancel as $k=>$v){
			$orders_cancel[] = array(
				'k'				=> $k,
				'title'			=> $v['title'],
				'selected'		=> $i == 0 ? 'selected' : '',
			);
			$i++;
		}
	}
	include ADMIN_TPL.'orders_cancel.htm';

}elseif($type == 'print'){   
	$C_ORDER = new order($orders_id);
	$allow_print = $C_ORDER->allow_print();
	if(!$allow_print){
        admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
    }
	
	$C_ORDER->order_product();
	$order_products = $C_ORDER->order_product;
	$C_ORDER->order_total();
	$order_totallist = $C_ORDER->order_total;
	$order_history = $C_ORDER->order_history();
	$order_detail = $C_ORDER->order_detail();

	include ADMIN_TPL.'orders_print.htm';

}elseif($type == 'search'){   

	include DIR_dzsw.'includes/ordersstatus.php';
	include ADMIN_TPL.'orders_search.htm';

}else{
	
	$num_a_page = "20";
	
	$page = $page ? $page : '1';
	$start = ($page - 1) * $num_a_page ;

	$orders_id_s = $orders_id_s != "" ? split("[,]", $orders_id_s) : NULL;
	$orders_ids = get_strings($orders_id_s);

	$conditions = "";
	$conditions.= $orders_ids != "" ? " AND  o.orders_id in ($orders_ids)" : NULL;
	$conditions.= $dorb_name != "" ? " AND (o.d_name LIKE '%$dorb_name%' OR o.d_name='$dorb_name' or o.b_name LIKE '$dorb_name' or o.b_name='$dorb_name')" : NULL;
	$conditions.= $products_name != "" ? " AND (op.name LIKE '%$products_name%' OR op.name='$products_name')" : NULL;
	$conditions.= $customers_email != "" ? " AND (c.email LIKE '%$customers_email%' OR o.c_email='$customers_email')" : NULL;
	$conditions.= $customers_id != "" ? " AND o.cid='$customers_id' " : NULL;
	$conditions.= $orders_status_insert != "" ? " AND o.orders_status = '" .$orders_status_insert . "' " : NULL;
	$conditions.= $order_total_b != "" ? " AND ot.value < '" . (int)$order_total_b . "' " : NULL;
	$conditions.= $order_total_s != "" ? " AND ot.value > '" . (int)$order_total_s . "' " : NULL;
   
	$conditions.= $payment_method != "" ? " AND (o.payment_method='$payment_method')" : NULL;
   
	$searchfrom = $before ? '<=' : '>=';
	$searchfrom .= $timestamp - $datefrom;
	$conditions.= $datefrom != "" ? " AND o.date_purchased $searchfrom " : NULL;

	$query = $db->query("SELECT distinct o.orders_id FROM ".
		
		" ".$table_pre."orders o ".
		" LEFT JOIN ".$table_pre."orders_total ot ON (o.orders_id = ot.orders_id) ".
		" LEFT JOIN ".$table_pre."orders_products op ON (op.orders_id = o.orders_id) ". 
		" LEFT JOIN ".$table_pre."customers c ON (c.customers_id = o.cid) ". 

		" WHERE ot.classes = 'total' $conditions");

	$link_parm = "orders_id_s=$orders_id_s&customers_name=$customers_name&customers_email=$customers_email&orders_status_insert=$orders_status_insert";
	$multipage = s_multi($db->num_rows($query), $num_a_page, $page, 'admin.php?act=orders&'.$link_parm);
	
	$query = $db->query("SELECT distinct  ".
		" o.orders_id, o.cid, o.date_purchased, o.last_modified, o.orders_status , ".
		" ot.value as order_total , ".
		" c.email ".
		" FROM ".
		
		" ".$table_pre."orders o ".
		" LEFT JOIN ".$table_pre."orders_total ot ON (o.orders_id = ot.orders_id) ".
		" LEFT JOIN ".$table_pre."orders_products op ON op.orders_id = o.orders_id ".
		" LEFT JOIN ".$table_pre."customers c ON (c.customers_id = o.cid) ". 

		" WHERE ot.classes = 'total' $conditions ORDER BY o.orders_id DESC LIMIT $start ,$num_a_page");

	if(!is_array($orders_status_array)){
		include DIR_dzsw.'includes/ordersstatus.php';
	}
	while ($order = $db->fetch_array($query)) {
		$order['order_total']		= display_price($order['order_total']);
		$order['date_purchased']	= $order['date_purchased'] ? gmdate($settings['date_format'], $order['date_purchased'] + $settings['time_ofset'] * 3600) : "";

		$order['orders_status']		= $orders_status_array[$order['orders_status']]['title'];

		$order['customer_name']		= $order['email'];

		$orders[] = $order;
	}
	include ADMIN_TPL.'orders_show.htm';
   
}



?>

