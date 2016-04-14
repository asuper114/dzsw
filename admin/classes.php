<?php

/*----------------------------------------------------
	[dzsw] admin/classes.php 
----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if(!$allow_class_see && $admingroupsid !=1){
    admin_msg($lang_a_common['forbid']);
}

if($action == 'add'){
	if(!$allow_class_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}	
	if($classes_array_1){
		$db->query("insert into $table_classes (title,parent_id,classes) values ('$classes_array_1','0','1')");
	}
	if($classes_array_2){
		$db->query("insert into $table_classes (title,parent_id,classes) values ('$classes_array_2','$classes_parent_id_1','2')");
	}
	if($classes_array_3){
		$db->query("insert into $table_classes (title,parent_id,classes) values ('$classes_array_3','$classes_parent_id_2','3')");
	}
	if($classes_array_4){
		$db->query("insert into $table_classes (title,parent_id,classes) values ('$classes_array_4','$classes_parent_id_3','4')");
	}

	updatecache('classes');
	admin_msg($lang_a_classes['message_class_add_success'],'admin.php?act=classes');

}elseif($action == 'savesort'){
	if(!$allow_class_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	if(is_array($sort)){    
		foreach($sort as $key=>$val){
			$db->query("update $table_classes set sort_order='$val' where classes_id = '" . (int)$key . "'");
		}
		updatecache('classes');
	}
	$action = '';

}elseif($action == 'saveedit'){
	if(!$allow_class_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	if($classes_id){
		if($parent_classes_id>0){
			$get_one = $db->get_one("select classes from $table_classes where classes_id ='".(int)$parent_classes_id."'");
			$classes_ = $get_one['classes'] + 1;
			$query_classes = ", classes = '".$classes_."'";
			$query_parent = ", parent_id = '".$parent_classes_id."'";
		}
		$db->query("update $table_classes set title='$title' ".$query_parent." ".$query_classes." ,showinheader='".$showinheader."' where classes_id ='".(int)$classes_id."'");

		updatecache('classes');
	}
	admin_msg($lang_a_classes['message_class_edit_success'],'admin.php?act=classes');

}elseif($action == 'delete'){
	if(!$allow_class_delete && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$childids = class_allchildids($classes_id,$childids);
	$allids = $childids!='' ? $childids.",'$classes_id'" : "'$classes_id'";

	$query = $db->query("select pid from $table_ptoc where cid in ($allids)");
	while ($query_data = $db->fetch_array($query)) {
		remove_product($query_data['pid']);
	}
	$db->query("delete from $table_classes where classes_id in ($allids)");
	$db->query("delete from $table_ptoc where cid in ($allids)");
	updatecache('classes');
	admin_msg($lang_a_classes['message_class_delete_success'],'admin.php?act=classes'); 

}elseif($action == 'merge'){
	if(!$allow_class_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$continue_do = true;
	if($formerly_classes == $aim_classes){
		$continue_do = false;
    }
	if($formerly_classes && $aim_classes && $continue_do == true){
		$check_formerly = $db->get_one("select classes from $table_classes where classes_id = '" . (int)$formerly_classes. "'");

		$check_aim = $db->get_one("select classes from $table_classes where classes_id = '" . (int)$aim_classes. "'");
		if($check_formerly['classes'] == $check_aim['classes']){
			$db->query("update $table_classes set parent_id='$aim_classes' where parent_id = '" . (int)$formerly_classes . "'");
            $db->query("update $table_ptoc set cid='$aim_classes' where cid = '" . (int)$formerly_classes . "'");
            $db->query("delete from $table_classes where classes_id = '" . (int)$formerly_classes . "'");						
			updatecache('classes');
		}
	}
	admin_msg($lang_a_classes['message_class_merge_success'],'admin.php?act=classes');

}elseif($action == 'showinheader'){
	if(!$allow_class_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	if(is_array($showinheader)){
		foreach($showinheader as $key=>$val){
			if(!is_numeric($val) && $val){
			}else{
				$val = $val ? $val : '0';
				$db->query("update $table_classes set showinheader='$val' where classes_id = '" . (int)$key . "'");
			}
		}
		updatecache('classes');
	}
	admin_msg($lang_a_message['update_success'],'admin.php?act=classes&type=showinheader');

}

if($type == 'add'){
	if(!$allow_class_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}
	$query_1 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '0' and classes='1' order by sort_order, title");
	$option_1=$option_2=$option_3=$option_4='';
	while ($category_1= $db->fetch_array($query_1)) {
		$option_1.='<option value="'.$category_1['classes_id'].'" >'.$category_1['title'].'</option>';
		$query_2 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$category_1['classes_id']."' and classes='2' order by sort_order, title");
		while ($category_2= $db->fetch_array($query_2)) {
			$option_2.='<option value="'.$category_2['classes_id'].'" >'.$category_2['title'].'</option>';
			$query_3 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$category_2['classes_id']."' and classes='3' order by sort_order, title");
			while ($category_3= $db->fetch_array($query_3)) {   
				$option_3.='<option value="'.$category_3['classes_id'].'" >'.$category_3['title'].'</option>';
			}
		}
	}
	include ADMIN_TPL.'classes_add.htm'; 

}elseif($type == 'edit'){
	if(!$allow_class_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}
	$details = $db->get_one("SELECT classes_id,title, parent_id,sort_order, classes, showinheader FROM $table_classes  WHERE classes_id ='" . (int)$classes_id . "'");
	$classes_select = classes_select_parent($details['classes'],$details['parent_id']);
	
	include ADMIN_TPL.'classes_edit.htm'; 	

}elseif($type == 'delete'){
	if(!$allow_class_delete && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}		
	$class_data = $db->get_one("SELECT classes_id,title FROM $table_classes  WHERE classes_id = '" . (int)$classes_id. "'");

	$childs_num = class_allsubnum($class_data['classes_id'],$childs_num);
	$childids = class_allchildids($classes_id,$childids);

	$allsubcid = $childids ? $childids.",'".$classes_id."'" : "'".$classes_id."'";

	$pid_data = $db->get_one("SELECT count(DISTINCT pid) as count FROM $table_ptoc WHERE cid IN ($allsubcid)");
	$products_num = $pid_data['count'];

	include ADMIN_TPL.'classes_delete.htm';
	
}elseif($type == 'merge'){
	if(!$allow_class_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}
	$classes_select = classes_select($formerly_id);
	if($formerly_id != ''){
		$query_data = $db->get_one("select classes,classes_id from $table_classes  where classes_id = '" . (int)$formerly_id. "'");
		$query = $db->query("select * from $table_classes where classes='".$query_data['classes']."' and classes_id!='".$query_data['classes_id']."'");
		$classes_select_aim = '';
		while($query_data = $db->fetch_array($query)){
			$spacer = '';
			for($i=1;$i<$query_data['classes'];$i++){
				$spacer .= '©¦';
			}
			$spacer .= '©À&nbsp;';
			$classes_select_aim .= '<option value="'.$query_data['classes_id'].'">'.$spacer.$query_data['title'].'</option>';
		}	
	}
	include ADMIN_TPL.'classes_merge.htm';

}elseif($type == 'showinheader'){
	$query = $db->query("SELECT classes_id, title,showinheader  FROM $table_classes where showinheader>0 ORDER BY showinheader,sort_order");	
	$showinheader_array = array();
	while($data = $db->fetch_array($query)) {
		$showinheader_array[]= $data;
	}
	include ADMIN_TPL.'classes_showinheader.htm';
}

if(!$action && !$type){
    $calsses_all = '';
	$query_1 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes   where parent_id = '0' and classes='1' order by sort_order, title");
    while ($category_1= $db->fetch_array($query_1)) {
        $calsses_all.='<ul><li><b>'.$category_1['title'].'</b> - '.$lang_common['sort_'].' <input type="text" size="2" name="sort['.$category_1['classes_id'].']" value="'.$category_1['sort_order'].'"> - <a href="admin.php?act=classes&type=edit&classes_id='.$category_1['classes_id'].'">['.$lang_common['edit'].']</a>&nbsp;<a href="admin.php?act=classes&type=delete&classes_id='.$category_1['classes_id'].' " target="_blank">['.$lang_common['delete'].']</a>'; 
		$query_2 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes   where parent_id = '".$category_1['classes_id']."' and classes='2' order by sort_order, title");
        while ($category_2= $db->fetch_array($query_2)) {
            $calsses_all.='<ul><li><b>'.$category_2['title'].'</b> - '.$lang_common['sort_'].'<input type="text" size="2" name="sort['.$category_2['classes_id'].']" value="'.$category_2['sort_order'].'"> - <a href="admin.php?act=classes&type=edit&classes_id='.$category_2['classes_id'].'">['.$lang_common['edit'].']</a>&nbsp;<a href="admin.php?act=classes&type=delete&classes_id='.$category_2['classes_id'].'">['.$lang_common['delete'].']</a>'; 
			$query_3 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes  where parent_id = '".$category_2['classes_id']."' and classes='3' order by sort_order, title");
            while ($category_3= $db->fetch_array($query_3)) {   
                $calsses_all.='<ul><li><b>'.$category_3['title'].'</b> - '.$lang_common['sort_'].'<input type="text" size="2" name="sort['.$category_3['classes_id'].']" value="'.$category_3['sort_order'].'"> - <a href="admin.php?act=classes&type=edit&classes_id='.$category_3['classes_id'].'">['.$lang_common['edit'].']</a>&nbsp;<a href="admin.php?act=classes&type=delete&classes_id='.$category_3['classes_id'].'">['.$lang_common['delete'].']</a>'; 
				$query_4 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes  where parent_id = '".$category_3['classes_id']."' and classes='4' order by sort_order, title");
                while ($category_4= $db->fetch_array($query_4)) {    
                    $calsses_all.='<ul><li><b>'.$category_4['title'].'</b> - '.$lang_common['sort_'].'<input type="text" size="2" name="sort['.$category_4['classes_id'].']" value="'.$category_4['sort_order'].'"> - <a href="admin.php?act=classes&type=edit&classes_id='.$category_4['classes_id'].'">['.$lang_common['edit'].']</a>&nbsp;<a href="admin.php?act=classes&type=delete&classes_id='.$category_4['classes_id'].'">['.$lang_common['delete'].']</a>'; 
					$calsses_all.='</ul>';
                } 
                $calsses_all.='</ul>';
            }
            $calsses_all.='</ul>';
        }
        $calsses_all.='</ul>';
    }
    include ADMIN_TPL.'classes_all.htm'; 
}

function class_allsubnum($classes_id,&$num) {
    global $db, $table_classes;

    $query = $db->query("select classes_id from $table_classes where parent_id = '" . (int)$classes_id . "'");
    while ($childs_data = $db->fetch_array($query)) {
        $num = 1+$num;
		$id_array = class_allsubnum($childs_data['classes_id'],$num);
    }
    return $num;
} 
function class_allchildids($cid, &$childids) {
	global $db, $table_classes;
	$query = $db->query("select classes_id, parent_id from $table_classes where parent_id = '" . (int)$cid . "'");
	while ($childs_data = $db->fetch_array($query)) {
		if($childs_data['parent_id'] == $cid){
			if($childids){
				$childids = $childids.",'".$childs_data['classes_id']."'";
			}else{
				$childids = "'".$childs_data['classes_id']."'";
			}
			classes_childids($childs_data['classes_id'], $childids);
		}
	}
	return $childids;
}

function classes_select_parent($type = '',$classes_id = ''){	
   	global $db, $table_classes;
	if($type == '2' || $type == '3' || $type == '4'){
		$query_1 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '0' and classes='1' order by sort_order, title");
		$classes_array = '';
		while ($classes_1 = $db->fetch_array($query_1)) {
			$classes_array .= ($type == '2') ? '<option value="'.$classes_1['classes_id'].'" '.($classes_1['classes_id']==$classes_id ? "selected" : "" ).'>├&nbsp;'.$classes_1['title'].'</option>' : '';
			if($type == '3' || $type == '4'){	
				$query_2 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$classes_1['classes_id']."' and classes='2' order by sort_order, title");
			
				while ($classes_2 = $db->fetch_array($query_2)) {
					$classes_array .= ($type == '3') ? '<option value="'.$classes_2['classes_id'].'" '.($classes_2['classes_id']==$classes_id ? "selected" : "" ).'>│├&nbsp;'.$classes_2['title'].'</option>' : '';
					if($type == '4'){		
						$query_3 = $db->query("select classes_id, title, parent_id, sort_order from $table_classes where parent_id = '".$classes_2['classes_id']."' and classes='3' order by sort_order, title");
						while ($classes_3 = $db->fetch_array($query_3)) {
							$classes_array .= '<option value="'.$classes_3['classes_id'].'" '.($classes_3['classes_id']==$classes_id ? "selected" : "" ).'>││├&nbsp;'.$classes_3['title'].'</option>';
						}
					}
				}
			}
		}
	}
	return $classes_array;
}
