<?php

/*----------------------------------------------------
	[dzsw] admin/admin.php 

----------------------------------------------------*/


if(!defined("IN_dzsw")) {
   exit("Access Denied");
}

if($admingroupsid != '1'){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'detail'){
	$do_edit = true;
	$get_one = $db->get_one("select count(*) as count from $table_admins where adminid!='$adminid_' and email='$email'");
	if($get_one['count'] > 0){
		$do_edit = false;
		$message_all[] = $lang_a_admin['msg_account_exists'];
	}
	if($do_edit){
		$get_one = $db->get_one("select admingroupsid, password from $table_admins where adminid='$adminid_'");
		if($get_one['admingroupsid'] == '1'){
			if($groupidnew!='1'){
				$get_one = $db->get_one("select count(*) as count from $table_admins where admingroupsid='1' and adminid!='$adminid_'");
				if($get_one['count']<1){
					$do_edit = false;
					$message_all[] = $lang_a_admin['msg_account_notyou'];
				}
			}
		}
	}
	
	$password_query = '';
	if($do_edit){
		if($password){
			if(strlen($password) < 6) {
				$do_edit = false;
				$message_all[] = $lang_a_admin['msg_password_small'];
			}else{
                $password_query = ", password='".md5($password)."' ";
            }
        }
    }
	
	if($do_edit){
		$createdate = strtotime($createdate);
		$lastvisit = strtotime($lastvisit);
		$db->query("UPDATE $table_admins SET email='$email', admingroupsid='$groupidnew', createdate='$createdate', lastvisit='$lastvisit' $password_query where adminid='$adminid_'");
		admin_msg($lang_a_message['update_success'],'admin.php?act=admin');
	}else{
		$type = 'detail';
	}
}elseif($action == 'add'){

	$continue_do = true;
	if(!$email) { 
		$continue_do = false;
		$message_all[] = $lang_a_admin['msg_account_empty'];
	}elseif (strlen($password) < 6) {
		$continue_do = false;
		$message_all[] = $lang_a_admin['msg_password_small'];
	}elseif ($password != $password2) {
		$continue_do = false;
		$message_all[] = $lang_a_admin['msg_password_notsame'];
	}
	if ($continue_do == true) {
		$get_one = $db->get_one("select count(*) as count from $table_admins where email = '" .$email. "'");
		if ($get_one['count']<1){
			$password = md5($password);
			$db->query("insert into $table_admins (email,password,admingroupsid,createdate,lastvisit) values ('$email','$password','$agid','".$timestamp."','".$timestamp."')");
			admin_msg($lang_a_message['update_success'],'admin.php?act=admin');
		}else {
            $continue_do = false;
			$message_all[] = $lang_a_admin['msg_account_exists'];
		}
	}
	if($continue_do == false){
		$type = 'add';
	}
}elseif($action == 'delete'){
	if(is_array($delete)) {
		foreach($delete as $id) {
			$get_one = $db->get_one("select admingroupsid from $table_admins where adminid='$id'");
			if($get_one['admingroupsid'] != '1'){
				$db->query("delete from $table_admins where adminid='$id'","ub");
			}
		}
	}
	admin_msg($lang_a_message['update_success'],'admin.php?act=admin');
}

if($type == 'detail'){
	
	$get_one = $db->get_one("select * from $table_admins where adminid='$adminid_'");
    $get_one_group = $db->get_one("select classes from $table_admingroups where admingroupsid='".$get_one['admingroupsid']."'");

    $get_one['createdate'] = gmdate($settings['date_format'], $get_one['createdate']+ $settings['time_ofset'] * 3600);
	$get_one['lastvisit'] = gmdate($settings['date_format'], $get_one['lastvisit']+ $settings['time_ofset'] * 3600);
			      
    $query = $db->query("select * from $table_admingroups ");
    while($admin = $db->fetch_array($query)){
        $admingroup_array[] = $admin;    
    }
    include ADMIN_TPL.'admin_detail.htm';

}elseif($type == 'add'){
	
	$query = $db->query("select * from $table_admingroups ");
	while($admin = $db->fetch_array($query)){
		$admingroup_array[] = $admin;    
	}
	include ADMIN_TPL.'admin_add.htm';

}

if(!$type && !$action){

	$query = $db->query("select * from $table_admins");
    while($admin = $db->fetch_array($query)){
        $admin_array[] = $admin;    
    }
	include ADMIN_TPL.'admin.htm';

}

?>
