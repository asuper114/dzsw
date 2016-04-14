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

	function adminoption_1($gbookall_data){
		global $lang_gbook, $lang_common;
		
		$show_adminoption_1 = '';
		$allow_toreply = $this->allow_toreply($gbookall_data);
		if($allow_toreply){
			$show_adminoption_1 .= '<a href="admin.php?frameact=gbook&type=reply&gid='.$gbookall_data['gid'].'" target="_blank">'.$lang_gbook['reply'].'</a>';
			$space = ' ';
		}

		$allow_toreply = $this->allow_edit_main($gbookall_data);
		if($allow_toreply){
			$show_adminoption_1 .= $space.'<a href="admin.php?frameact=gbook&type=edit&gid='.$gbookall_data['gid'].'" target="_blank">'.$lang_common['edit'].'</a>';
		}

		$show_adminoption_1 = $show_adminoption_1 != '' ? '<br />'.$lang_common['adminoption_'].$show_adminoption_1 : '';
		return $show_adminoption_1;
	}

	function adminoption_2($gbookall_data){
		global $lang_gbook, $lang_common;
		
		$show_adminoption_2 = '';
		$allow_edit_reply = $this->allow_edit_reply($gbookall_data);
		if($allow_edit_reply){
			$show_adminoption_2 .= '<a href="admin.php?frameact=gbook&type=editreply&grid='.$gbookall_data['grid'].'" target="_blank">'.$lang_common['edit'].'</a>';
		}

		$show_adminoption_2 = $show_adminoption_2 != '' ? '<br />'.$lang_common['adminoption_'].$show_adminoption_2 : '';
		return $show_adminoption_2;
	}

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

?>