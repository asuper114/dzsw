<?php

/*----------------------------------------------------
	[dzsw] admin/news.php 
----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if(!$allow_news_edit && !$allow_news_add && !$allow_news_delete){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'save'){
	if($editorstatus == 'normal'){
		$text = htmlspecialchars($text);
	}
	if($id){
		if(!$allow_news_edit){
			admin_msg($lang_a_common['forbid']);
		}
		$sql_data_array = array(
			'subject'		=> $subject,
			'last_edit'		=> $timestamp,
			'editer'		=> $adminid,
			'text'			=> $text
		);   
		$db->perform($table_news, $sql_data_array,'update',"id='".$id."'");
		updatecache("news");
		admin_msg($lang_a_message['news_update_success'],'admin.php?act=news');
	}else{
		if(!$allow_news_add){
			admin_msg($lang_a_common['forbid']);
		}
		$sql_data_array = array(
			'subject'		=> $subject,
			'date_add'		=> $timestamp,
			'editer'		=> $adminid,
			'text'			=> $text
		);   
		$db->perform($table_news, $sql_data_array);
		updatecache("news");
		admin_msg($lang_a_message['news_add_success'],'admin.php?act=news');
	}
}elseif($action == 'delete'){
	if(!$allow_news_delete){
		admin_msg($lang_a_common['forbid']);
	}
	$db->query("delete from $table_news where id = '" . (int)$id . "'");
	updatecache("news");
	admin_msg($lang_a_message['news_delete_success'],'admin.php?act=news');
}

if($type == 'edit'){

	if(!$allow_news_edit){
		admin_msg($lang_a_common['forbid']);
	}
	$news_data = $db->get_one("select id, subject, text from $table_news where id='$id'");
	//$news_data[text] = s_unhtmlspecialchars($news_data[text]);
	include ADMIN_TPL.'news_add.htm'; 

}elseif($type == 'add'){

	if(!$allow_news_add){
		admin_msg($lang_a_common['forbid']);
	}
	include ADMIN_TPL.'news_add.htm'; 
}

if(!$type && !$action){
    $num_a_page = '10';
	$page = $page ? $page : '1';
	$startlimit = ($page - 1) * $num_a_page ;
    
    $query = $db->query("SELECT COUNT(*) from $table_news");
    $multipage = s_multi($db->result($query, 0), $num_a_page, $page, 'admin.php?act=news');
    $query = $db->query("select id, subject, date_add from $table_news order by date_add DESC LIMIT $startlimit,$num_a_page");
	while ($query_data = $db->fetch_array($query)) {

		$news_all[] = $query_data;
    }
    include ADMIN_TPL.'news.htm';    
}

?>

