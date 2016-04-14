<?php
/*
	[dzsw] moreimage.php 

*/
define('CURRSCRIPT','moreimage');

require('includes/global.php');

if (strstr($_SERVER[HTTP_USER_AGENT], "MSIE")) {
	$attachment = '';
} else {
	$attachment = ' atachment;';
} 

if(!$pid){
     exit("error!");
}

$get_one = $db->get_one("select count(*) as count from $table_source where pid='".$pid."'");
if(!$get_one['count']){
	exit("This product has no picture.");
}

$total = $get_one['count'];
$page = (int)$page ? $page : '1';
$start = $page-1;
$get_one = $db->get_one("select id, title, path, extension, name from $table_source where pid='".$pid."' order by id limit $start, 1");

$imagesrc = get_image_src($get_one,'common');

$multipage = s_multi($total, 1, $page,"moreimage.php?pid=".$pid);

/*
header('Expires: '.date('D,d M Y H:i:s',mktime(0,0,0,1,1,2000)).' GMT');
header('Last-Modified:'.gmdate('D,d M Y H:i:s').' GMT');
header('Cache-control: private, no-cache,must-revalidate');
header('Pragma: no-cache');
*/
include template("moreimage");

?>