<?php

/*--------------------------------------------------------------

	[dzsw] includes/admin/cla.gbook.php 

--------------------------------------------------------------*/

include DIR_dzsw.'includes/cla.gbook_p.php';

class gbook extends gbook_p{
	
	var $gid				= '';
	var $grid				= '';

	function gbook(){
		global $db;
		$this->db = $db;

	}

	function allow_editreply($grid){
		global $adminid;
		$this->reply_data($grid);
		if($reply_data['adminid'] == $adminid || $adminid == '1'){
			return true;
		}else{
			return false;
		}

	}


	function delete_main($gid){
		global $table_pre;
		$this->db->query("delete from ".$table_pre."gbookreply where parent_id = '" . (int)$gid . "' limit 1");
		$this->db->query("delete from ".$table_pre."gbook where gid = '" . (int)$gid . "' limit 1");
	}

	function adminoption_1($gbookall_data){
		global $lang_a_gbook, $lang_common;
		
		$show_adminoption_1 = '';
		$allow_toreply = $this->allow_toreply($gbookall_data);
		if($allow_toreply){
			$show_adminoption_1 .= '<a href="admin.php?act=gbook&type=reply&gid='.$gbookall_data['gid'].'">'.$lang_a_gbook['reply'].'</a>';
			$space = ' ';
		}

		$allow_toreply = $this->allow_edit_main($gbookall_data);
		if($allow_toreply){
			$show_adminoption_1 .= $space.'<a href="admin.php?act=gbook&type=edit&gid='.$gbookall_data['gid'].'">'.$lang_common['edit'].'</a>';
			$space = ' ';
		}

		$allow_delete_main = $this->allow_delete_main($gbookall_data);
		if($allow_delete_main){
			$show_adminoption_1 .= $space.'<a href="admin.php?act=gbook&action=delete&gid='.$gbookall_data['gid'].'">'.$lang_common['delete'].'</a>';
		}
		
		$show_adminoption_1 = $show_adminoption_1 != '' ? '<br />'.$show_adminoption_1 : '';
		return $show_adminoption_1;

	}

	function adminoption_2($gbookall_data){
		global $lang_gbook, $lang_common;
		
		$show_adminoption_2 = '';
		$allow_edit_reply = $this->allow_edit_reply($gbookall_data);
		if($allow_edit_reply){
			$show_adminoption_2 .= '<a href="admin.php?act=gbook&type=editreply&grid='.$gbookall_data['grid'].'">'.$lang_common['edit'].'</a>';
		}

		$show_adminoption_2 = $show_adminoption_2 != '' ? '<br />'.$show_adminoption_2 : '';
		return $show_adminoption_2;

	}

	/*
	$array_s = array(
		'page'			=> '',
		'numapage'		=> '',
		'link'			=> '',
	);
	*/
	function show_gbook_list($array_s){
		global $settings;
		$gbook_list = $this->gbook_list($array_s);
		if(!is_array($gbook_list['list'])){
			return false;
		}
		$gbook_array = array();
		$gbook_array['multipage'] = $gbook_list['multipage'];
		foreach($gbook_list['list'] as $k=>$v){
			$gbook_array['list'][] = array(
				'gid'					=> $v['gid'],	
				'cid'					=> $v['cid'] ? $v['cid'] : '',	
				'date_add'				=> gmdate($settings['date_format'], $v['date_added']+ $settings['time_ofset'] * 3600),
				'textmain'				=> $v['textmain'],	
				'textreply'				=> $v['textreply'],	
				'adminoption_1'			=> $this->adminoption_1($v),	
				'adminoption_2'			=> $this->adminoption_2($v),
			);
		}
		return $gbook_array;

	}
}
