<?php
/*----------------------------------------------------
	[dzsw] admin/gbook.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if(!$allow_gbook_edit && !$allow_gbook_delete && !$allow_gbook_reply){
    admin_msg($lang_a_common['forbid']);
}

include DIR_dzsw.'includes/admin/cla.gbook.php';

if($action == 'reply'){
	if(!$allow_gbook_reply){
		admin_msg($lang_a_common['forbid']);
	}
	
	$sql_data_array = array(   
		'text'				=> $textreply,
		'parent_id'			=> $gid,
		'adminid'			=> $adminid,
		'last_modified'		=> $timestamp
	);   
	$db->perform($table_pre."gbookreply", $sql_data_array,'replace');
	admin_msg($lang_a_message['update_success'],'admin.php?act=gbook');  

}elseif($action == 'edit'){
	if(!$allow_gbook_edit){
		admin_msg($lang_a_common['forbid']);
	}
	$sql_data_array = array(
		'text'				=> $textmain,
		'last_modified'		=> $timestamp
	);   
	$db->perform($table_gbook, $sql_data_array,'update',"gid='".$gid."'");
	admin_msg($lang_a_message['update_success'],'admin.php?act=gbook');

}elseif($action == 'editreply'){
	$C_GOOBK = new gbook();
	$allow_edit_reply = $C_GOOBK->allow_edit_reply($grid);
	if(!$allow_edit_reply){
		admin_msg($lang_a_common['forbid']);
	}

	$sql_data_array = array(
		'text'				=> $textreply,
		'last_modified'		=> $timestamp
	);   

	$db->perform($table_pre."gbookreply", $sql_data_array,'update',"grid='".$grid."'");
	admin_msg($lang_a_message['update_success'],'admin.php?act=gbook');

}elseif($action == 'delete'){
	if(!$allow_gbook_delete){
		admin_msg($lang_a_common['forbid']);
	}

	$C_GOOBK = new gbook();
	$C_GOOBK->delete_main($gid);

	admin_msg($lang_a_message['update_success'],'admin.php?act=gbook');

}
/*elseif($action == 'editclass'){
	if($ids = get_strings($delete)) {
		$db->query("DELETE FROM	$table_gbook_class WHERE id IN ($ids)");
	}

	if(is_array($title)) {
		foreach($title as $id =>$val) {
			$db->query("UPDATE $table_gbook_class SET title='$title[$id]' WHERE id='$id'");
		}
	}

	if($titlenew != '') {
		$db->query("INSERT INTO	$table_gbook_class (title) VALUES ('$titlenew')");
	}

	updatecache('index');
	admin_msg($lang_a_message['update_success'],'admin.php?act=gbook&type=class');
}
*/
if($type == 'reply'){
	if(!$allow_gbook_reply){
		admin_msg($lang_a_common['forbid']);
	}
	$C_GOOBK = new gbook();
	$C_GOOBK->one_data($gid);
	$one_data = $C_GOOBK->one_data;

	include ADMIN_TPL.'gbook_reply.htm'; 

}elseif($type == 'edit'){
	if(!$allow_gbook_edit){
		admin_msg($lang_a_common['forbid']);
	}
	
	$C_GOOBK = new gbook();
	$C_GOOBK->main_data($gid);
	$main_data = $C_GOOBK->main_data;

	include ADMIN_TPL.'gbook_edit.htm'; 

}elseif($type == 'editreply'){
	$C_GOOBK = new gbook();
	$allow_edit_reply = $C_GOOBK->allow_edit_reply($grid);
	if(!$allow_edit_reply){
		admin_msg($lang_a_common['forbid']);
	}

	$C_GOOBK->reply_data($grid);
	$reply_data = $C_GOOBK->reply_data;

	$C_GOOBK->main_data($reply_data['gid']);
	$main_data = $C_GOOBK->main_data;

	include ADMIN_TPL.'gbook_editreply.htm'; 

}
/*elseif($type == 'class'){
	$query = $db->query("select * from $table_gbook_class order by id");
	$gbook_class_array = array();
	while ($gbook_class_data = $db->fetch_array($query)) {
		$gbook_class_array[] = $gbook_class_data;
	}
	include ADMIN_TPL.'gbook_class.htm'; 

}
*/

if(!$type && !$action){

	$C_GOOBK = new gbook();
	$array_s = array(
		'page'			=> $page,
		'numapage'		=> '20',
		'link'			=> 'admin.php?act=gbook',
	);
	$gbooks_data = $C_GOOBK->show_gbook_list($array_s);
	$gbooks = $gbooks_data['list'];
	$multipage = $gbooks_data['multipage'];

	include ADMIN_TPL.'gbook.htm';
}

?>