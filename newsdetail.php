<?php

/*----------------------------------------------------
	[dzsw] newslist.php 

----------------------------------------------------*/
define('CURRSCRIPT','newsdetail');
require('includes/global.php');
require DIR_dzsw.'languages/newsdetail.php';

$news_exist = true;
if($id){ 
   $news_data = $db->get_one("select id, subject,text, editer, date_add from $table_news where id='$id'");
   if(is_array($news_data)){
		$news_data['text'] = s_unhtmlspecialchars($news_data['text']);
		$news_data['date_add'] = gmdate($settings['date_format'], $news_data['date_add'] + $settings['time_ofset'] * 3600);
		//$editer = $news_data['editer'];
		define('NAVBAR_TITLE_2', $news_data['subject']);
	}else{
		$news_exist=false;
		define('NAVBAR_TITLE_2', LANG_NEWS_EXISTNO);
	}
}else{
	$news_exist = false;
	define('NAVBAR_TITLE_2', LANG_NEWS_EXISTNO);
}

$page_trail[] = array('title'=>$lang_newsdetail['navbar'],'link'=>'newslist.php');
$page_trail[] = array('title'=>$news_data['subject']);
$page_position = page_trail();
include template("newsdetail");

?>
