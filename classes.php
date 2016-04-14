<?php

/*---------------------------------------------------
	[dzsw] classes.php 

---------------------------------------------------*/
define('CURRSCRIPT','classes');
require('includes/global.php');

include DIR_dzsw.'languages/classes.php';
include DIR_dzsw.'includes/user/cla.classes.php';

$C_CLASSES = new classes($classes_id);

$C_CLASSES->check();
$class_name = $C_CLASSES->class_name();
$class_name_left = $C_CLASSES->class_name_left();

$childs	= $C_CLASSES->childs();

$products_array	= $C_CLASSES->get_list();

$page_trail = classes_trail_parent($classes_id, $page_trail);
$page_position = page_trail();
include template("classes");
