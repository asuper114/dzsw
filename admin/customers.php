<?php

/*----------------------------------------------------
	[dzsw] admin/customers.php 

----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if(!$allow_customer_see && $admingroupsid !=1){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'search'){

	$page = $page ? $page : '1';
	$startlimit = ($page - 1) * 20;

	$conditions = "";
	$conditions .= $email != "" ? " AND (email LIKE '%$email%' OR email='$email')" : NULL;
	$conditions .= $groupid != "" ? " AND groupid ='$groupid'" : NULL;
	$conditions .= $cfrom != "" ? " AND credit >'$cfrom'" : NULL;
	$conditions .= $cto != "" ? " AND credit <'$cto'" : NULL;
	$conditions = substr($conditions, 5); 
	$conditions = $conditions != "" ? " where $conditions " : NULL;
	$get_one = $db->get_one("SELECT COUNT(*) as count FROM $table_customers $conditions");
				 
	$link_all = "email=$email&groupid=$groupid&cfrom=$cfrom&cto=$cto";
	$multipage = s_multi($get_one['count'], 20, $page, 'admin.php?act=customers&action=search&'.$link_all);

	$query = $db->query("select * from $table_usergroups where classes != 'Guest'");
	$usergroup_array = array();
	while($usergroup = $db->fetch_array($query)){
		$usergroup_array[] = $usergroup;    
	}

	$query = $db->query("SELECT * FROM $table_customers $conditions order by customers_id desc LIMIT $startlimit, 20");
	$customer_array = array();
	while($customer = $db->fetch_array($query)) {
		$customer['showgroup'] = array();
		foreach($usergroup_array as $val){
			if($val['classes'] == 'Specials'){
				$customer['showgroup'][] = $val['groupid'];
			}elseif($customer['credit'] >= $val['creditshigher'] && $customer['credit']<$val['creditslower']){
				$customer['showgroup'][] = $val['groupid'];
			}
		}
		$customer_array[] = $customer;    
	}
	reset($usergroup_array);
	include ADMIN_TPL.'customers_all.htm';

}elseif($action == 'editall'){
	if(is_array($delete)) {
		if(!$allow_customer_delete && $admingroupsid !=1){
			admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
		}
		$ids = get_strings($delete);
		if($ids){
			$db->query("DELETE FROM $table_customers WHERE customers_id IN ($ids)");
			$db->query("DELETE FROM $table_address_book WHERE cid IN ($ids)");
			unset($ids);
		}
	}
		
	if(is_array($groupidnew)) {
		if(!$allow_customer_edit && $admingroupsid !=1){
			admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
		}							 
		foreach($groupidnew as $id => $val) {
			$db->query("UPDATE $table_customers SET groupid='$groupidnew[$id]'  WHERE customers_id='$id'");
		}
	}

	admin_msg($lang_a_message['operate_success'],'javascript:history.back(-1);');

}elseif($action == 'editdetail'){
	if(!$allow_customer_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}	

	$continue_do = true;

	$regdate = strtotime($regdate);
	$lastvisit = strtotime($lastvisit);

	if (!eregi("^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]",$email)) {
		$message_all[] = $lang_a_customer['msg_email_format_error']; 
		$continue_do = false;
	}
	if($continue_do == true){
		$sql_data_array = array(
			'email'			=> $email,
			'groupid'		=> $groupidnew,
			'regdate'		=> $regdate,
			'lastvisit'		=> $lastvisit,
			'qq'			=> $qq,
			'msn'			=> $msn,

		);
		if(strlen($password)>6){
			$sql_data_array['password'] = md5($password);
        }
		if($settings['user_leavepay'] == 'true'){
			$sql_data_array['money'] = $money;
        }

        $db->perform($table_customers, $sql_data_array,'update'," customers_id = '$customers_id' ");
		admin_msg($lang_a_message['update_success'],'javascript:history.back(-1);');
	}else{
        $type = 'detail';
    }
}

if($type == 'detail'){
	if($c_email){
		$customer = $db->get_one("SELECT * FROM $table_customers  where email='$c_email'");
	}else{
		$customer = $db->get_one("SELECT * FROM $table_customers  where customers_id='$customers_id'");
	}

	$customer['regdate'] =  gmdate($settings['date_format'], $customer['regdate'] + $news_data['date_add'] * 3600);
	$customer['lastvisit'] =  gmdate($settings['date_format'], $customer['lastvisit'] + $news_data['date_add'] * 3600);
	$query = $db->query("select * from $table_usergroups where classes != 'Guest'");
	while($usergroup = $db->fetch_array($query)){
		if($usergroup['classes'] == 'Specials'){
			$usergroup['show'] = '1';
		}elseif($customer['credit'] >= $usergroup['creditshigher'] && $customer['credit']<$usergroup['creditslower']){
			$usergroup['show'] = '1';
		}
		$usergroup_array[] = $usergroup;
	}

	include ADMIN_TPL.'customers_detail.htm';
}


if(!$action && !$type){
	$query = $db->query("select * from $table_usergroups where classes != 'Guest'");
	while($usergroup = $db->fetch_array($query)){
		$usergroup_array[] = $usergroup;    
	}
	include ADMIN_TPL.'customers.htm';
}

?>