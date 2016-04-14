<?php

/*----------------------------------------------------
	[dzsw] admin/template.php 
----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($admingroupsid != '1'){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'edit'){
	$continue_do = true;
	if($title_new){
		
		if($continue_do == true){	
			if(substr(trim($directory_new), -1) == '/'){
				$continue_do = false;
				$message_all[] = $lang_a_msg['template_directory_error_1'];
			}	
		}
		if($continue_do == true){	
			if(!is_dir(DIR_dzsw.'templates/'.$directory_new)){
				$continue_do = false;
				$message_all[] = sprintf($lang_a_msg['template_directory_error_2'],$directory_new,$directory_new);
			}
		}

		if($continue_do == true){
			$db->query("INSERT INTO $table_templates (title, directory) VALUES ('$title_new', '$directory_new')");
		}
	}

	if($continue_do == true){
		if(is_array($directorynew )){
			foreach($directorynew as $id => $directory) {
				if(!$delete || ($delete && !in_array($id, $delete))) {
					if(!is_dir(DIR_dzsw.'templates/'.$directory)) {
						$continue_do = false;
						$message_all[] = sprintf($lang_a_msg['template_directory_error_2'],DIR_dzsw.'templates/'.$directory,DIR_dzsw.'templates/'.$directory);
					} 
					if($id == 1 && $directory != 'default') {
						$continue_do = false;
						$message_all[] = $lang_a_msg['template_edit_detaultdirectory_error'];
					}
					if($continue_do == true){
						$sql_data_array = array(
							'title'			=> $titlenew[$id],
							'directory'		=> $directorynew[$id],
						);

						$db->perform($table_templates, $sql_data_array,'update'," tid = '$id' ");
					}
				}
			}
		}
	}   
			
	if($continue_do == true){
		if(is_array($delete)) {
			if(in_array('1', $delete)) {
				$continue_do = false;
				$message_all[] = $lang_a_msg['template_delete_detault_error'];
			}
			if($continue_do == true){    
				$ids = $comma = '';
				foreach($delete as $id) {
					$ids .= "$comma'$id'";
					$comma = ', ';
				}
				$db->query("DELETE FROM $table_templates WHERE tid IN ($ids) AND tid<>'1'","ub");
				$db->query("UPDATE $table_styles SET tid='1' WHERE tid IN ($ids)","ub");
			}
		}
	}

	updatecache('styles');
	if($continue_do == true){  
		admin_msg($lang_a_message['operate_success'],'admin.php?act=template'); 
	}else{
		$action = '';
	}
}

if(!$action){
	$query = $db->query("SELECT * FROM $table_templates");
    $template_array = array(); 
    if($delete){
        $delete = $delete;
    }else{
        $delete = array();
    }
	while($query_data = $db->fetch_array($query)) {
		foreach($delete as $val){
			($query_data['tid'] == $val && $val!='1') ? $query_data['checked'] = 'checked' : '';
		}
		$template_array[] = $query_data;
	}
	include ADMIN_TPL.'template.htm';
}


?>