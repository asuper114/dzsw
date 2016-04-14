<?php

/*----------------------------------------------------
	[dzsw] includes/classes.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}
	 
function classesselect_search() {
	$cache_classes = $GLOBALS['cache_classes'];

	if(!is_array($cache_classes)){
		include(cacheexists('classes'));
	}

	$classesselectlist = '';
	if(is_array($cache_classes)){
		foreach($cache_classes as $value){
			if($value['parent_id'] == '0'){
				$classesselectlist .= '<option value="'.$value['classes_id'].'">├'.$value['title'].'</option>';
				foreach($cache_classes as $value2) {
					if($value2['parent_id'] == $value['classes_id'])  {
					$classesselectlist.='<option value="'.$value2['classes_id'].'">│├'.$value2['title'].'</option>';
						foreach($cache_classes as $value3) {
							if($value3['parent_id'] == $value2['classes_id'])  { 
							$classesselectlist.='<option value="'.$value3['classes_id'].'">││├'.$value3['title'].'</option>';
								foreach($cache_classes as $value4) {
									if($value4['parent_id'] == $value3['classes_id']){ 
										$classesselectlist.='<option value="'.$value4['classes_id'].'">│││├'.$value4['title'].'</option>';
									}
								}
							}
						}
					}
				}   
			}
		}
	}

	return $classesselectlist;	 
}	 	 
	 

function classes_trail_parent($cid, &$page_trail) {
	global $cache_classes;
	if(!is_array($page_trail)){
		$page_trail = array();
	}
	if(!is_array($cache_classes)){
		include(cacheexists('classes'));
	}
	if(is_array($cache_classes)){
		foreach($cache_classes as $cat_key => $cat_value) {
			if($cat_value['classes_id'] == $cid){
				$page_trail[] = array('title'=>$cat_value['title'],'link'=>'classes.php?classes_id='.$cid);
				classes_trail_parent($cat_value['parent_id'], $page_trail);
			}
		}
	}
	krsort($page_trail);
	return $page_trail;
}

function classes_childids($cid, &$childids) {
	$cache_classes = $GLOBALS['cache_classes'];
	
	if(!is_array($cache_classes)){
		include_once(cacheexists('classes'));
	}
	
	if(is_array($cache_classes)){
		foreach($cache_classes as $cat_key => $cat_value) {
			if($cat_value['parent_id'] == $cid){
				if($childids){
					$childids = $childids.",'".$cat_value['classes_id']."'";
				}else{
					$childids = "'".$cat_value['classes_id']."'";
				}
				classes_childids($cat_value['classes_id'], $childids);
			}
		}
	}
	return $childids;
}

function classes_select($classes_id = ''){	
   	global $db, $table_classes;
	$query_1 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '0' and classes='1' order by sort_order, title");
    $classes_array = '';
	while ($classes_1 = $db->fetch_array($query_1)) {
         $classes_array .= '<option value="'.$classes_1['classes_id'].'" '.($classes_1['classes_id']==$classes_id ? "selected" : "" ).'>├&nbsp;'.$classes_1['title'].'</option>';
		 $query_2 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$classes_1['classes_id']."' and classes='2' order by sort_order, title");
         while ($classes_2 = $db->fetch_array($query_2)) {
              $classes_array .= '<option value="'.$classes_2['classes_id'].'" '.($classes_2['classes_id']==$classes_id ? "selected" : "" ).'>│├&nbsp;'.$classes_2['title'].'</option>';
			  $query_3 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$classes_2['classes_id']."' and classes='3' order by sort_order, title");
              while ($classes_3 = $db->fetch_array($query_3)) {
                   $classes_array.='<option value="'.$classes_3['classes_id'].'" '.($classes_3['classes_id']==$classes_id ? "selected" : "" ).'>││├&nbsp;'.$classes_3['title'].'</option>';
				   $query_4 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$classes_3['classes_id']."' and classes='4' order by sort_order, title");
                   while ($classes_4 = $db->fetch_array($query_4)) {
                        $classes_array .= '<option value="'.$classes_4['classes_id'].'" '.($classes_4['classes_id']==$classes_id ? "selected" : "" ).'>│││├ &nbsp;'.$classes_4['title'].'</option>';
				   }
			  }
         }
    }
	return $classes_array;
}