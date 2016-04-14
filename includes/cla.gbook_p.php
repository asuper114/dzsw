<?php

/*--------------------------------------------------------------
	[dzsw] includes/cla.gbook_p.php 

--------------------------------------------------------------*/

class gbook_p{
	
	var $gid						= '';
	var $grid						= '';
	var $main_data					= '';
	var $reply_data					= '';
	var $one_data					= '';

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}	

	function main_data($gid){
		global $table_pre;
		if($this->main_data != ''){
			return true;
		}
		$main_data = $this->db->get_one("select gid, text as textmain, date_added from ".$table_pre."gbook where gid = '" . (int)$gid . "'");
		$this->main_data = $main_data;

	}


	function one_data($gid){
		global $table_pre;
		if($this->one_data != ''){
			return true;
		}
		$one_data = $this->db->get_one("SELECT g.gid, g.text as textmain, g.date_added, ".
			"gr.text as textreply, gr.adminid, gr.grid FROM ".

			$table_pre."gbook g ".
			"left join ".$table_pre."gbookreply gr ON g.gid=gr.parent_id ".

			"WHERE g.gid='$gid'");
		$this->one_data = $one_data;

	}

	function reply_data($grid){
		global $table_pre;
		if($this->reply_data != ''){
			return true;
		}
		$reply_data = $this->db->get_one("select grid, parent_id as gid, text as textreply, adminid from ".$table_pre."gbookreply where grid = '" . (int)$grid . "'");
		$this->reply_data = $reply_data;

	}
	
	function allow_toreply($one_data){
		global $adminid, $allow_gbook_reply;
		
		$allow_toreply = false;
		if($one_data['textreply'] == ''){
			if($adminid != ''){
				if($allow_gbook_reply || $adminid == '1'){
					$allow_toreply = true;
				}
			}
		}
		return $allow_toreply;

	}

	function allow_edit_main($main_data = ''){
		global $adminid, $allow_gbook_edit;
		
		$allow_edit_main = false;
		if($adminid != ''){
			if($allow_gbook_edit || $adminid == '1'){
				$allow_edit_main = true;;
			}
		}
		return $allow_edit_main;

	}

	function allow_edit_reply($reply_data = ''){
		global $adminid;
		
		if(!is_array($reply_data)){
			$this->reply_data($reply_data);
			$reply_data = $this->reply_data;
		}

		$allow_edit_reply = false;
		if($reply_data['textreply'] != ''){
			if($reply_data['adminid'] == $adminid || $adminid == '1'){
				$allow_edit_reply = true;;
			}
		}
		return $allow_edit_reply;

	}

	function allow_delete_main($gbookall_data){
		global $adminid, $allow_gbook_delete;
		
		$allow_delete_main = false;
		if($adminid != ''){
			if($allow_gbook_delete || $adminid == '1'){
				$allow_delete_main = true;;
			}
		}
		return $allow_delete_main;

	}

	function gbook_list($array_s){
		global $table_pre;
		$numapage = (is_numeric($array_s['numapage']) && $array_s['numapage']>0) ? $array_s['numapage'] : 10;

		$page = $array_s['page'] ? $array_s['page'] : '1';
		$startlimit = ($page-1) * $numapage;
		$get_one = $this->db->get_one("SELECT distinct count(*) as count FROM ".$table_pre."gbook");

		$gbooks_array = array();
		$gbooks_array['multipage'] = s_multi($get_one['count'],$numapage,$page,$array_s['link']);

		$query = $this->db->query("SELECT distinct g.gid, g.cid, g.text as textmain, g.date_added, ".
			"gr.text as textreply, gr.adminid, gr.grid FROM ".

			$table_pre."gbook g ".
			"left join ".$table_pre."gbookreply gr ON g.gid=gr.parent_id ".

			"order by g.gid desc limit $startlimit, $numapage");
		while ($gbook_data = $this->db->fetch_array($query)) {
			$gbooks_array['list'][] = $gbook_data;
		}
		return $gbooks_array;

	}

}
