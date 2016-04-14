<?php

/*----------------------------------------------------
	[dzsw] admin/group_customers.php 
----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($action == 'edit_member_group'){
	if(is_array($delete)) {
		$ids = $space = "";
		foreach($delete as $k=>$v) {
			$ids .= $space."'".$k."'";
			$space = ',';
		}
		if($ids){
			$db->query("delete from $table_usergroups where groupid in ($ids)");
		}
	}	
	
	if(is_array($group_title)) {
		$ids = $comma = "";
		foreach($group_title as $id => $title) {
			$db->query("UPDATE $table_usergroups SET grouptitle='$group_title[$id]', creditshigher='$group_creditshigher[$id]', creditslower='$group_creditslower[$id]', groupdiscount='$group_discount[$id]' WHERE groupid='$id'",'ub');
		}
	}	
	if($group_titlenew){
		$db->query("insert into $table_usergroups (grouptitle,creditshigher,creditslower,groupdiscount) values ('$group_titlenew','$group_creditshighernew','$group_creditslowernew','$group_discountnew')");
	}

	updatecache("usergroups");
	admin_msg($lang_a_customer['mssage_update_success'],'admin.php?act=group_customers');
}elseif($action == 'edit_specils_group'){
	$db->query("UPDATE $table_usergroups SET grouptitle='$specifiedusers_group_title', groupdiscount='$specifiedusers_discount' WHERE classes='specials'");
	
	updatecache("usergroups");	admin_msg($lang_a_customer['mssage_update_speiclas_success'],'admin.php?act=group_customers');
}

if(!$action){
	
	$admingroup = "";
	$upperlimit = $lowerlimit = $misconfig = 0;
	$group_common = $group_specials = array();
	$query = $db->query("SELECT groupid, classes, grouptitle, creditshigher, creditslower, groupdiscount FROM $table_usergroups where classes!='Guest' ORDER BY creditslower");
	while($query_data = $db->fetch_array($query)) {
		if($query_data[classes] == "Specials"){
			$group_specials = $query_data;
		}else{
			$group_common[] = $query_data;
		}
	}

    include ADMIN_TPL.'group_customers.htm';
}

?>
