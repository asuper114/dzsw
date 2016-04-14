<?php

/*----------------------------------------------------
	[dzsw] search.php 


----------------------------------------------------*/
define('CURRSCRIPT','search');
require('includes/global.php');

require DIR_dzsw.'languages/search.php';


$products_array = array();
if($action == 'search'){
	
	$s_array = array(
		'keywords'			=> $keywords,
		'cludedesc'			=> $cludedesc,
		'manufacturer'		=> $manufacturer,
		'pfrom'				=> $pfrom,
		'pto'				=> $pto,
		'classes_id'		=> $classes_id,
		'cludesub'			=> $cludesub
	);
	$check_result = false;
	foreach($s_array as $v){
		if($v != ''){
			$check_result = true;
		}
	}

	if($check_result){
		include DIR_dzsw.'includes/user/cla.products.php';
		$C_SEARCH = new products();

		marksearchhistory($s_array);
		$C_SEARCH->__set('type','search');
		$products_array = $C_SEARCH->get_list($s_array);

		if(is_array($products_array['detail']) && $products_array['detail']['0']){

			$page_trail[] = array('title'=>$lang_search['navbar_title_1'],'link'=>'search.php');
			$page_trail[] = array('title'=>$lang_search['navbar_title_2']);
			$page_position = page_trail();
			include template("search_result");

		}else{			
			$checked_cludedesc = ($cludedesc=='1') ? 'checked' : '';
			$checked_cludesub = ($cludesub=='1') ? 'checked' : '';
			$message_all[] = $lang_search['search_emtpy'];;
		}	
	}else{
		$message_all[] = $lang_search['pam_emtpy'];
	}
}

$classesselect_search = classesselect_search();

$page_trail[] = array('title' => $lang_search['navbar_title_1']);
$page_position = page_trail();
include template("search");


?>
