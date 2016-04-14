<?php
function splitstr_sql($sqlstring){
	$sql_array = array();
	$i = 0;
	$sqlstring = str_replace("\r", "\n", $sqlstring);
	foreach(explode(";\n", trim($sqlstring)) as $query) {
		$query_array = explode("\n", trim($query));
		foreach($query_array as $query) {
		   $sql_array[$i] .= $query[0] == '#' || $query[0].$query[1] == '--' ? NULL : $query;
		}
		$i++;
	}
	return $sql_array;
}
function admin_msg($message, $url_forward = '', $msgtype = 'message'){
	global $lang_common, $styles, $lang_a_message, $lang_common;
	if($msgtype == 'form') {
		$message_ = '<form method="post" action="'.$url_forward.'"><br><br><br>'.$message.'<br><br><br><br>'.
        			'<input type="submit" name="confirmed" value=" '.$lang_common['submit'].' "> &nbsp; '.
       				'<input type="button" name="button" value=" '.$lang_common['back'].' " onclick="javascript:history.go(-1);"></form><br>';
	}elseif($msgtype == 'back'){
	    $message_ = '<br><br><br>'.$message.'<br><br><input type="button" name="button" value=" '.$lang_common['back'].' " onclick="javascript:history.back(-1);" class="bginput"><br>';
	}elseif($url_forward) {
		if($url_forward == 'referer'){
			$url_forward = $_SERVER['HTTP_REFERER'];
		}
		$message_ .= '<br>'.$message.'<br><br><a href="'.$url_forward.'">['.$lang_a_message['check_to_turn'].']</a><meta http-equiv="refresh" content="2;url='.$url_forward.'">';
	}else {
		$message_ = "<br><br><br>$message<br><br>";
	}
	include ADMIN_TPL.'admin_msg.htm';
	output();
}
function remove_product($product_id) {
	global $db, $table_products, $table_specials, $table_ptoc, $table_source, $table_reviews;

    $db->query("delete from $table_products where products_id = '" . (int)$product_id . "' limit 1");

	$db->query("delete from $table_specials where pid = '" . (int)$product_id . "' limit 1");

    $db->query("delete from $table_ptoc where pid = '" . (int)$product_id . "'");

    $query = $db->query("select id from $table_source where pid = '" . (int)$product_id . "' ");
	while($image_data = $db->fetch_array($query)){
		deleteimage($image_data['id']);
	}
	
	$db->query("delete from $table_reviews where products_id = '" . (int)$product_id . "'");
}

function deleteimage($id){
	global $db, $table_source, $table_products;
	$get_one_1 = $db->get_one("select pid, name, extension, path from $table_source where id = '" . (int)$id . "' limit 1");

	$get_one = $db->get_one("select image from $table_products where products_id='".$get_one_1['pid']."'");

	if($get_one['image'] == $id){
		//return false;
	}

	$get_one = $db->get_one("select count(*) as count from $table_source where pid != '" . (int)$get_one_1['pid'] . "' and name = '".$get_one_1['name']."' ");

	$db->query("delete from $table_source where id = '" . (int)$id . "' limit 1");
	if($get_one['count'] > 0){
		return false;
	}
	@unlink(DIR_dzsw.'upload/common/'.$get_one_1['path'].'/'.$get_one_1['name'].$get_one_1['extension']);
	@unlink(DIR_dzsw.'upload/small/'.$get_one_1['path'].'/'.$get_one_1['name'].'.jpg');
	@unlink(DIR_dzsw.'upload/small2/'.$get_one_1['path'].'/'.$get_one_1['name'].'.jpg');
}

function picture_savepath(){
	global $settings;
	if($settings['picture_savepath'] == 'default'){
		$savepath = '';
	}elseif($settings['picture_savepath'] == 'byday'){
		$savepath = date('Y').'/'.date('m').'/'.date('d');
	}
	return $savepath;
}