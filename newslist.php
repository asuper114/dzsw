<?php

/*
	[dzsw] newslist.php 


*/
define('CURRSCRIPT','newslist');
require('includes/global.php');
require DIR_dzsw.'languages/newslist.php';

$num_a_page = "16";
	
$page = $page ? $page : '1';
$start = ($page - 1) * $num_a_page ;

$get_one = $db->get_one("select count(*) as count from $table_news");

$multipage = s_multi($get_one['count'], $num_a_page, $page, 'newslist.php?news=news');

$query = $db->query("select id, subject,date_add from $table_news order by date_add desc limit $start,$num_a_page");
$dzsw_news = array();
while ($news_data = $db->fetch_array($query)) {
   $dzsw_news[] = array(
	   'id'			=> $news_data['id'],
	   'subject'	=> $news_data['subject'],
	   'date'		=> gmdate($settings['date_format'], $news_data['date_add']+ $settings['time_ofset'] * 3600),
	);
} 

$page_trail[] = array('title'=>$lang_newslist['navbar']);
$page_position = page_trail();
include template("newslist");

?>
