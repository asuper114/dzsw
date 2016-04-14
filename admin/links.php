<?php

/*
	[dzsw] admin/links.php 
*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if(!$allow_links_edit && !$allow_links_add && !$allow_links_delete && $admingroupsid !=1){
    admin_msg($lang_a_common['forbid']);
}

if($action == 'edit'){

	if($ids = get_strings($delete)) {
		if(!$allow_links_delete && $admingroupsid !=1){
			admin_msg($lang_a_common['forbid']);
		}else{
			$db->query("DELETE FROM	$table_links WHERE	id IN ($ids)");
		}
	}
	if(!$allow_links_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}elseif(is_array($ordernum)) {
		foreach($ordernum as $id =>	$val) {
			$db->query("UPDATE $table_links SET ordernum='$ordernum[$id]' WHERE id='$id'");
		}
	}

	updatecache('links');
	$action = $type = '';

}elseif($action == 'save'){

	if($id){
		if(!$allow_links_edit && $admingroupsid !=1){
			admin_msg($lang_a_common['forbid']);
		}
		$sql_data_array = array(
			'name'		=> $name,
			'url'		=> $url,
			'logo'		=> $logo,
		);   
		$db->perform($table_links, $sql_data_array,'update',"id='".$id."'");
		updatecache('links');
		admin_msg($lang_a_message['link_update_success'],'admin.php?act=links');
	}else{
		if(!$allow_links_add && $admingroupsid !=1){
			admin_msg($lang_a_common['forbid']);
		}
		$sql_data_array = array(
			'name'		=> $name,
			'url'		=> $url,
			'logo'		=> $logo,
		);   
		$db->perform($table_links, $sql_data_array);
		updatecache('links');
		admin_msg($lang_a_message['link_add_success'],'admin.php?act=links');
	}
}

if($type == 'detail'){
	
	if(!$allow_links_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}

	$links_data = $db->get_one("select * from $table_links where id='$lid'");
	include ADMIN_TPL.'links_add.htm';

}elseif($type == 'add'){

	if(!$allow_links_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}
	include ADMIN_TPL.'links_add.htm';

}

if(!$type && !$action){

	$links = '';
	$query = $db->query("select * from $table_links order by ordernum");
	while($link = $db->fetch_array($query)) {
		$links[] = $link;
	}
	include ADMIN_TPL.'links.htm';

}

?>

