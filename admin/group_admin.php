<?php

/*----------------------------------------------------
	[dzsw] admin/group_admin.php 


----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($admingroupsid != '1'){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'detail'){

	$orderstatus_ = get_strings($orderstatus_,'forothor');
	$orderstatus_g = get_strings($orderstatus_g,'forothor');

	$sql_data_array = array(
		'allow_class_see'		=> $allow_class_seenew,
		'allow_class_edit'		=> $allow_class_editnew,
		'allow_class_add'		=> $allow_class_addnew,
		'allow_class_delete'	=> $allow_class_deletenew,

		'allow_product_see'		=> $allow_product_seenew,
		'allow_product_edit'	=> $allow_product_editnew,
		'allow_product_add'		=> $allow_product_addnew,
        'allow_product_delete'	=> $allow_product_deletenew,
                              
		'allow_order_see'		=> $allow_order_seenew,
                              
		'allow_customer_see'	=> $allow_customer_seenew,   
		'allow_customer_edit'	=> $allow_customer_editnew,   
		'allow_customer_add'	=> $allow_customer_addnew,
		'allow_customer_delete' => $allow_customer_deletenew,
                              
		'allow_news_edit'		=> $allow_news_editnew,
		'allow_news_add'		=> $allow_news_addnew,
		'allow_news_delete'		=> $allow_news_deletenew,
                              
		'allow_gbook_edit'		=> $allow_gbook_editnew,
		'allow_gbook_delete'	=> $allow_gbook_deletenew,
		'allow_gbook_reply'		=> $allow_gbook_replynew,
                              
		'allow_links_edit'		=> $allow_links_editnew,
		'allow_links_add'		=> $allow_links_addnew,
		'allow_links_delete'	=> $allow_links_deletenew,

		'allow_sendmail'		=> $allow_sendmailnew,
		'allow_orderstatus'		=> $orderstatus_,
		'allow_orderstatus_g'	=> $orderstatus_g,
	);
	

	$db->perform($table_admingroups, $sql_data_array,'update'," admingroupsid='".$id."'");
	updatecache("admingroup");
	admin_msg($lang_a_message['update_success'],'admin.php?act=group_admin');

}elseif($action == 'update_adminer'){
	if(!is_array($delete)){
		$delete = array();
	}
	if(is_array($agid)){
		foreach($agid as $k=>$v){
			if(!in_array($k,$delete)){
				$db->query("UPDATE $table_admins SET admingroupsid='$v' WHERE adminid='$k'");
			}
		}
	}
	$ids = get_strings($delete);
	if($ids){
		$db->query("DELETE FROM $table_admins WHERE adminid IN ($ids)","ub");
	}

	admin_msg($lang_a_message['update_success'],'admin.php?act=group_admin');
}elseif($action == 'edit'){
    
	if(is_array($delete)) {
		$admins_array = array();
		$space_str = $ids = '';
		foreach($delete as $id) {
			$query = $db->query("select * from $table_admins where admingroupsid='$id'");
			$do_delete = false;
			while($admins = $db->fetch_array($query)){
				$do_delete = true;
				$admins_array[] = $admins;
			}
			if(!$do_delete){
				$ids .= "$space_str'$id'";
				$space_str = ',';
			}
		}

		if($admins_array['0']){
			$message_all[] = $lang_a_group_admin['delete_error'];
			$query = $db->query("SELECT admingroupsid, grouptitle, classes FROM $table_admingroups ");
			while($group = $db->fetch_array($query)) {
				$admingroup_array[] = $group;
			}
			include ADMIN_TPL.'group_admin_array.htm';
			exit;
		}else{
			$db->query("delete from $table_admingroups WHERE admingroupsid in ($ids)");
		}
	}
	if(is_array($group_title)) {
		foreach($group_title as $id => $title) {
			if($group_title[$id]){
				$db->query("UPDATE $table_admingroups SET grouptitle='$group_title[$id]' WHERE admingroupsid='$id'");
			}
		}
	}
	if($group_title_new){
		$db->query("insert into $table_admingroups (classes, grouptitle) values ('operator','$group_title_new')");
	}
	updatecache("admingroup");
	admin_msg($lang_a_message['update_success'],'admin.php?act=group_admin');
}

if($type=='detail'){
    
	$group = $db->get_one("SELECT * FROM $table_admingroups WHERE admingroupsid = '$id'");
	if(!is_array($orders_status_array)){
		include DIR_dzsw.'includes/ordersstatus.php';
	}

	$group['allow_orderstatus'] = explode(',',$group['allow_orderstatus']);
	$group['allow_orderstatus_g'] = explode(',',$group['allow_orderstatus_g']);

	$orderstatus_array = $orderstatus_g_array = array();
	if(is_array($orders_status_array)){
		foreach($orders_status_array as $key=>$val){
			$checked = in_array($key, $group['allow_orderstatus']) ? 'checked' : '';
			$orderstatus_array[] = array(
				'k'			=> $key,
				'title'		=> $val['title'],
				'checked'	=> $checked,
			);
		}
	}

	unset($orders_status_array);
	include DIR_dzsw.'includes/ordersstatus_g.php';
	if(is_array($orders_status_array)){
		foreach($orders_status_array as $key=>$val){
			$checked = in_array($key, $group['allow_orderstatus_g']) ? 'checked' : '';
			$orderstatus_g_array[] = array(
				'k'			=> $key,
				'title'		=> $val['title'],
				'checked'	=> $checked,
			);
		}

	}
    include ADMIN_TPL.'group_admin_detail.htm';

}else{
    
	$admingroup = array();
	$query = $db->query("SELECT admingroupsid, grouptitle, classes FROM $table_admingroups ");
	while($group = $db->fetch_array($query)) {
		$admingroup[] = $group;
	}
	include ADMIN_TPL.'group_admin.htm';
}


?>
