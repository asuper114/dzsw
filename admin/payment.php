<?php

/*----------------------------------------------------
	[dzsw] admin/payment.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if($admingroupsid != '1'){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'updatepa'){
	$continue_do = true;

	if($paid == ''){
		$continue_do = false;
	}

	if($continue_do == true && $pakey != ''){
		$payment_data = $db->get_one("select pid from $table_payment_a where id = '".$paid."'");	
		$payment_data2 = $db->get_one("select count(*) as count from $table_payment_a where pakey = '".$pakey."' and pid = '".$payment_data['pid']."' and id != '".$paid."'");
		if($payment_data2['count'] > 0){
			$continue_do = false;
			$message_all[] = $lang_a_msg['payment_pakey_exists'];
		}
	}

	if($continue_do == true){
		$sql_data_array = array(
			'pvalue'		=> $pvalue,
			'sort_order'	=> $sort_order,
		);
		if($pakey != ''){
			$sql_data_array = array_merge($sql_data_array, array('pakey'=>$pakey));
		}
		if($title != ''){
			$sql_data_array = array_merge($sql_data_array, array('title'=>$title));
		}
		$db->perform($table_payment_a, $sql_data_array,'update',"id='".(int)$paid."'");
		updatecache("payment");
		admin_msg($lang_a_message['update_success'],'referer');
	}else{
		$type = 'edit';
		$pid = $payment_data['pid'];
	}

}elseif($action == 'operatestatus'){
	if ( ($flag == '0') || ($flag == '1') ) {
		if(isset($id)) {
			$db->query("update $table_payment set status = '".$flag."' where id = '" . (int)$id. "'");
        }
	}
	updatecache("payment");
	$url_referer = $_SERVER[HTTP_REFERER];
	header("location:$url_referer");
	exit;

}elseif($action == 'editsort'){
	if(is_array($sort)){
		foreach($sort as $key=>$val){
			$db->query("update $table_payment set sort_order='".$val."' where id='".$key."'");
		}
	}
	admin_msg($lang_a_message['update_success'],'referer');
}elseif($action == 'doedit'){

	$sql_data_array = array(
		'title'			=> $define_title,
		'description'	=> $description
	);
	$db->perform($table_payment, $sql_data_array,'update',"id='".(int)$id."'");
	updatecache("payment");
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'add_payment'){

	$continue_do = false;
	$message_all = array();

	$payment_data = $db->get_one("select pay_key from $table_payment where id ='".$payment_parent_id."' limit 1");
	if($payment_data['pay_key'] == 'banktransfer' || $payment_data['pay_key'] == 'online'){
		$continue_do = true;
	}

	if($continue_do == true){
		if($title && $pay_key){
			$payment_data_2 = $db->get_one("select count(*) as count from $table_payment where pay_key ='".$pay_key."'");
			if($payment_data_2['count'] > 0){
				$continue_do = false;
				$message_all[] = $lang_a_msg['payment_pay_key_exists'];
			}
		}else{
			$continue_do = false;
		}
	}

	if($continue_do == true){
		$db->query("insert $table_payment (title,pay_key,parentid,type) values ('$title','$pay_key','$payment_parent_id','define')");
		if($payment_data['pay_key'] == 'banktransfer'){
			$insert_id = $db->insert_id();
			$db->query("insert $table_payment_a (pid, pakey, type) values ('$insert_id','cartnum','define')");
			$db->query("insert $table_payment_a (pid, pakey, type) values ('$insert_id','manname','define')");
		}

		updatecache("payment");
		admin_msg($lang_a_message['update_success'],'referer');

	}else{
		$action = '';
	}

}elseif($action == 'delete'){

	$db->query("delete from $table_payment where id='$pid' and type='define' limit 1");

	$db->query("delete from $table_payment_a where pid='$pid' and type='define'");

	updatecache("payment");
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'delete_pa'){

	$db->query("delete from $table_payment_a where id='$paid' and type='define' limit 1");

	updatecache("payment");
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'addnewpa'){
	if($pid){
		$sql_data_array = array(
			'pid'	=> $pid,
			'type'	=> 'define',
		);
		$db->perform($table_payment_a, $sql_data_array);
		updatecache("payment");
	}
	admin_msg($lang_a_message['add_payment_a_success'],'referer');
}

if($type == 'edit'){
	
	$payment_detail = $db->get_one("select * from $table_payment where id = '" . (int)$pid. "'");
	$payment_detail['system_title'] = $lang_payment[$payment_detail['pay_key']];
	$payment_detail['title'] = payment_title($payment_detail,$lang_payment);

	if($payment_detail['parentid'] != '0'){
		$payment_data_2 = $db->get_one("select pay_key from $table_payment where id = '" .$payment_detail['parentid']. "'");
		$payment_detail['parent_pay_key'] = $payment_data_2['pay_key'];

		$query = $db->query("select * from $table_payment_a where pid = '" . (int)$pid. "' order by sort_order ");
		$payment_data = array();
		while($payment = $db->fetch_array($query)){
			
			$payment['system_title'] = $lang_payment[$payment['pay_key']];
			$payment['title'] = payment_a_title_admin($payment,$lang_payment_a,$payment_detail['pay_key']);	
			
			$payment_data[] = $payment;
		}
	}
	include ADMIN_TPL.'payment_edit.htm';

}

if(!$action && !$type){
	
	$query = $db->query("select * from $table_payment where parentid='0' order by sort_order");
	$payment_all = $payment_select = '';
	while($payment = $db->fetch_array($query)){
		$payment_all .= '<ul><li>'.$lang_common['sort:'].'<input type="text" size="2" name="sort['.$payment['id'].']" value="'.$payment['sort_order'].'"> - <b>('.$payment['pay_key'].') '.payment_title($payment,$lang_payment).'</b> - <a href="admin.php?act=payment&type=edit&pid='.$payment['id'].'">['.$lang_common['detail'].']</a> ';
		if($payment['type'] == 'define'){
			$payment_all .= '<a href="admin.php?act=payment&action=delete&pid='.$payment['id'].'">['.$lang_common['detail'].']</a>	';
		}
		$payment_all .= '#ID: <b>'.$payment['id'].'</b>'; 

		$query2 = $db->query("select * from $table_payment where parentid='".$payment['id']."' order by sort_order");
		$payment_all .= payment_status($payment['status'],$payment['id']);
		$payment_select .= ($payment['pay_key'] == 'banktransfer' || $payment['pay_key'] == 'online') ? '<option value="'.$payment[id].'" '.($payment_parent_id == $payment[id] ? "selected" : "") .'>'.payment_title($payment,$lang_payment).'</option>' : '';
		while($payment2 = $db->fetch_array($query2)){
			$payment_all.='<ul><li>'.$lang_common['sort:'].'<input type="text" size="2" name="sort['.$payment2['id'].']" value="'.$payment2['sort_order'].'"> - <b>('.$payment2['pay_key'].') '.payment_title($payment2,$lang_payment).'</b> - <a href="admin.php?act=payment&type=edit&pid='.$payment2['id'].'">['.$lang_common['detail'].']</a> ';
			
			if($payment2['type'] == 'define'){
				$payment_all .= '<a href="admin.php?act=payment&action=delete&pid='.$payment2['id'].'">['.$lang_common['delete'].']</a>	';
			}
			$payment_all .= '#ID: <b>'.$payment2['id'].'</b>'; 
			$payment_all .= payment_status($payment2['status'],$payment2['id']);
			$payment_all.='</ul>';
		}
		$payment_all.='</ul>';
	}

	include ADMIN_TPL.'payment.htm';
}

function payment_status($status,$id){
	global $lang_a_common;
	if($status=='1'){
		$payment_all = ' <a href="admin.php?act=payment&id='.$id.'&action=operatestatus&flag=0"><img src="images/admin/status_green.gif" border="0" alt="'.$lang_a_common['click_to_close'].'" title="'.$lang_a_common['click_to_close'].'"></a>';
	}else{
		$payment_all = ' <a href="admin.php?act=payment&id='.$id.'&action=operatestatus&flag=1"><img src="images/admin/status_red.gif" border="0" alt="'.$lang_a_common['click_to_open'].'" title="'.$lang_a_common['click_to_open'].'"></a>';
	}
	return $payment_all;
}

function payment_a_title_admin($payment_a_data,$lang_payment_a,$pay_key){
	if($payment_a_data['title']){
		$payment_a_title = $payment_a_data['title'];
	}elseif($lang_payment_a[$pay_key][$payment_a_data['pakey']]){
		$payment_a_title = $lang_payment_a[$pay_key][$payment_a_data['pakey']];
	}else{
		$payment_a_title = $payment_a_data['title'];
	}
	return $payment_a_title;
}


?>

