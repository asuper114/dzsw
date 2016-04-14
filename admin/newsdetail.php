<?php

/*
	[dzsw] admin/news.php 

*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if(!$allow_news_edit && !$allow_news_add && !$allow_news_delete){
	admin_msg(LANG_OPRATE_FORBID);
}

if($action == 'save'){
	if($editorstatus == 'normal'){
		$text = htmlspecialchars($text);
	}
	if($id){
		if(!$allow_news_edit){
			admin_msg(LANG_OPRATE_FORBID);
		}
		$sql_data_array = array(
			'subject'		=> $subject,
			'last_edit'		=> $timestamp,
			'editer'		=> $adminid,
			'text'			=> $text
		);   
		$db->perform($table_news, $sql_data_array,'update',"id='".$id."'");
		//updatecache("news");
		admin_msg(LANG_A_MESSAGE_NEWSUPDATESUCCESS,'admin.php?act=news');
	}else{
		if(!$allow_news_add){
			admin_msg(LANG_OPRATE_FORBID);
		}
		$sql_data_array = array(
			'subject'		=> $subject,
			'date_add'		=> $timestamp,
			'editer'		=> $adminid,
			'text'			=> $text
		);   
		$db->perform($table_news, $sql_data_array);
		//updatecache("news");
		admin_msg(LANG_A_MESSAGE_NEWSADDSUCCESS,'admin.php?act=news');
	}
}elseif($action == 'delete'){
	if(!$allow_news_delete){
		admin_msg(LANG_OPRATE_FORBID);
	}
	$db->query("delete from $table_news where id = '" . (int)$id . "'");
	//updatecache("news");
	admin_msg(LANG_A_MESSAGE_NEWSDELETESUCCESS,'admin.php?act=news');
}

if($type == 'edit'){
	if(!$allow_news_edit){
		admin_msg(LANG_OPRATE_FORBID);
	}
	$news_data = $db->get_one("select id, subject, text from $table_news where id='$id'");
	$news_data[text] = htmlspecialchars($news_data[text]);
	include ADMIN_TPL.'news_add.htm'; 
}elseif($type == 'add'){
	if(!$allow_news_add){
		admin_msg(LANG_OPRATE_FORBID);
	}
	include ADMIN_TPL.'news_add.htm'; 
}

if(!$type && !$action){
    $num_a_page = '2';
	$page = $page ? $page : '1';
	$startlimit = ($page - 1) * $num_a_page ;
    
    $query = $db->query("SELECT COUNT(*) from $table_news");
    $multipage = s_multi($db->result($query, 0), $num_a_page, $page, 'admin.php?act=news');
    $query = $db->query("select id, subject, date_add from $table_news order by date_add LIMIT $startlimit,$num_a_page");
	$altbg1 = ALTBG1;
	$altbg2 = ALTBG2;
	$productcount = 0;
	while ($news = $db->fetch_array($query)) {
		$bgno = $productcount++ % 2 + 1;
		$news[bgcolor] = ${'altbg'.$bgno};
		$news_all[] = $news;
    }
    include ADMIN_TPL.'news.htm';    
}

?>

