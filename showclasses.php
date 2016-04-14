<?php

/*---------------------------------------------------
	[dzsw] classes.php 


---------------------------------------------------*/
define('CURRSCRIPT','showclasses');
require('includes/global.php');

include DIR_dzsw.'languages/showclasses.php';

if(!is_array($cache_classes)){
	include(cacheexists('classes'));
}

$classes_box = $classes_box_sun_ = array();
if(is_array($cache_classes)){
	$classeslist = '';
	foreach($cache_classes as $value) {
		if($value['parent_id'] == '0')  {
			$classes_box[] = array(
				'classes_id'	=> $value['classes_id'],
				'strings'		=> '<a href="classes.php?classes_id='.$value['classes_id'].'">'.$value['title'].'</a>',
			);
		}elseif($value['classes'] == '2')  {
			$classes_box_sun_[$value['parent_id']] .= '<a href="classes.php?classes_id='.$value['classes_id'].'">'.$value['title'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}
	}
}

$page_trail[] = array(
	'title'		=> $lang_showclasses['navbar'],
	'link'		=> 'showclasses.php',
);
$page_position = page_trail();
include template("showclasses");

?>

