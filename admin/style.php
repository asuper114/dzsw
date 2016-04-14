<?php
/*----------------------------------------------------
	[dzsw] admin/styles.php 

----------------------------------------------------*/

if(!defined("IN_dzsw")) {
    exit("Access Denied");
}

if($admingroupsid != '1'){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'import'){
	$continue_do = true;

	if(!is_uploaded_file($_FILES['stylefile']['tmp_name'])){
		$continue_do = false;
	}

	
	if($continue_do == true) {
		$old_name = $style_filename = $_FILES['stylefile']['name'];
		if(file_exists(DIR_dzsw.'styles/'.$_FILES['stylefile']['name'])){
			$style_filename = s_random(4).'_'.$style_filename;
		}

		if(!move_uploaded_file($_FILES['stylefile']['tmp_name'], DIR_dzsw.'styles/'.$style_filename)){
			$continue_do = false;
		}
	}
	
	if($continue_do == true) {
		$cssfiletitle_array = explode('.',$style_filename);
		$old_name_array = explode('.',$old_name);
		$query_data = $db->get_one("SELECT tid FROM $table_templates WHERE directory='".$old_name_array['0']."'");
		$sql_data_array = array(
			'title'				=> $cssfiletitle_array['0'],
			'imagedir'			=> "images/".$old_name_array['0'],
			'cssfilename'		=> $style_filename,
			'tid'				=> $query_data['tid'],
		);
		$db->perform($table_styles, $sql_data_array);
		$insert_id = $db->insert_id();
		updatecache('styles');
	}
		
	admin_msg($lang_a_message['operate_success'], 'admin.php?act=style&type=detail&styleid='.$insert_id);

}elseif($action == 'edit_all'){

	$db->query("UPDATE $table_styles SET title='$newtitle', tid='$tidnew', cssfilename='$cssfilenamenew', imagedir='$imagedirnew' WHERE styleid='$styleid'");
	
	updatecache('styles');
	admin_msg($lang_a_message['operate_success'],'admin.php?act=style&type=detail&styleid='.$styleid);

}elseif($action == 'edit'){
	 
	 if(is_array($titlenew)) {
		  foreach($titlenew as $id => $val) {
			 $db->query("UPDATE $table_styles SET title='$titlenew[$id]'  WHERE styleid='$id'");
		  }
	 }
	$continue_ture = true;
	if(is_array($delete_array)) {
		$ids = $space_string = '';
		foreach($delete_array as $id) {
			$query_data = $db->get_one("SELECT count(*) as count FROM $table_settings WHERE settings_key = 'STORE_STYLE' and value='$id'");
			if($query_data['count']) {
				$message_all[] = $titlenew[$id].$lang_a_msg['style_cannot_delete'];
			}else{
				$ids .= "$space_string'$id'";
				$space_string  = ', ';
				$query_data = $db->get_one("SELECT cssfilename FROM $table_styles WHERE styleid = '$id' LIMIT 1");
				@unlink(DIR_dzsw.'styles/'.$query_data['cssfilename']);
			}
		}
		if($ids){
			$db->query("DELETE FROM $table_styles WHERE styleid IN ($ids)");
		}
	}

	updatecache('styles');
	$action = '';

}elseif($action == 'editfile'){
	if($fp = @fopen(DIR_dzsw.'styles/'.$cssfilename,'w')) {
	    fwrite($fp, $cssfilenamenew);
		fclose($fp);
	} else {
		admin_msg($lang_a_message['style_editfile_dirwriteerror']);
	}
	admin_msg($lang_a_message['style_editfile_success'],'admin.php?act=style');
}

if($type == 'detail'){

	$style_data = $db->get_one("SELECT title, tid, imagedir, cssfilename FROM $table_styles WHERE styleid='$styleid'");
	
	$template_array = "<select name=\"tidnew\">\n";
	$query = $db->query("SELECT tid, title FROM $table_templates");
	while($template = $db->fetch_array($query)) {
		$template_array .= "<option value=\"$template[tid]\"".($style_data['tid'] == $template['tid'] ? 'selected="selected"' : NULL).">$template[title]</option>\n";
	}
	$template_array .= '</select>';

	$stylefile_array = "<select name=\"cssfilenamenew\">\n";
	$path_id = opendir(DIR_dzsw.'styles/');
	while($file_name = readdir($path_id)) {
		if($file_name != "." && $file_name != ".." && $file_name != "admin.css") {
			$file['type'] = filetype(DIR_dzsw.'styles/'.$file_name);
			$extension = strtolower(substr(strrchr($file_name, '.'), 1));
			if($extension == 'css') {
				$stylefile_array .= "<option value=\"$file_name\"".($style_data['cssfilename'] == $file_name ? 'selected="selected"' : NULL).">$file_name</option>\n";
			}
		}
	}
	closedir($path_id);
	$stylefile_array .= '</select>';	

	include ADMIN_TPL.'style_show.htm';
}elseif($type == 'editfile'){
	$style_data = $db->get_one("SELECT title, tid, imagedir, cssfilename FROM $table_styles WHERE styleid='$styleid'");
	$file_contents = file_get_contents(DIR_dzsw.'styles/'.$style_data['cssfilename']);
	include ADMIN_TPL.'style_editfile.htm';
}

if(!$action && !$type){
	$stylearray = array();
	$query_data = $db->get_one("SELECT value FROM $table_settings WHERE settings_key = 'STORE_STYLE'");
	$default_style = $query_data;

	$query = $db->query("SELECT s.styleid, s.title, t.title AS templatename FROM $table_styles s LEFT JOIN $table_templates t ON t.tid=s.tid");
	if(is_array($delete_array)){
        $delete = $delete_array;
    }else{
        $delete = array();
    }
	while($query_data = $db->fetch_array($query)) {
		foreach($delete as $val){
			($query_data['styleid'] == $val && $val != $default_style['value']) ? $query_data['checked']='checked' : '';
		}
		$stylearray[] = $query_data;
	}
	include ADMIN_TPL.'style.htm';
}


?>
