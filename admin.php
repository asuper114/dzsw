<?php
/*----------------------------------------------------
	[dzsw] admin.php 

----------------------------------------------------*/

define('CURRSCRIPT','admin');

require	'./includes/global.php';
include DIR_dzsw.'includes/admin/fun.common.php';


if($act == 'top') {
	include(ADMIN_TPL.'top.htm');
	output();
}
if($act == 'menu') {
	include(DIR_dzsw.'admin/menu.php');
	output();
}
if($act == 'editor') {
	switch($type){
		case 'table':
	       include(ADMIN_TPL.'editor_table.htm');
	    break;
	    case 'colorlist':
	       include(ADMIN_TPL.'editor_colorlist.htm');
	    break;
	    case 'help':
	       include(ADMIN_TPL.'editor_help.html');
	    break;
	}
	output();
}
if($act == 'user_hidelist') {
	include(ADMIN_TPL.'user_hidelist.htm');
	output();
}

if (!$adminid || !$s_admingroupsid) {
   
	checkiillog();
	if($submit){
		$login_do = true;
		
		if(!$l_adminusername){
           
			$message_all[] = $lang_a_message['login_error_emailempty'];
			$login_do = false;
		}
		if(!$l_adminpassword){
			$message_all[] = $lang_a_message['login_error_passwordempty'];
			$login_do = false;
		}
		if(!$l_imgnum && $settings['user_checknum_infooter'] == 'true'){
			$message_all[] = $lang_a_message['login_error_passwordempty'];
			$login_do = false;
		}

		if($l_adminusername && $l_adminpassword && $login_do == true){
		       
			if($l_imgnum != $_SESSION['imgnum'] && $settings['user_checknum_infooter'] == 'true'){
				$message_all[] = $lang_a_message['login_error_checknumerror'];
			}else{
				
				$l_adminpassword = md5($l_adminpassword);

				$adminer_data = $db->get_one("SELECT adminid, admingroupsid FROM ".$table_pre."admins WHERE email='$l_adminusername' AND password='$l_adminpassword'");

				if($adminer_data['adminid']) {
					$_SESSION['s_adminid'] = $adminer_data['adminid'];
					$_SESSION['s_admingroupsid'] = $adminer_data['admingroupsid'];
					
					if($settings['user_checknum_infooter'] == 'true'){
						$_SESSION['imgnum'] == '';
						unset($_SESSION['imgnum']);
					}
					admin_msg($lang_a_message['login_success'],'admin.php');
				}else{
					$message_all[] = $lang_a_message['login_error_ill'];
					if($_SESSION['admincp_iillog'] > 0){
						$_SESSION['admincp_iillog']++;
					}else{
						$_SESSION['admincp_iillog'] = 1;
						$_SESSION['admincp_iiltime'] = $timestamp;
					}
					$_SESSION['s_adminid']='';
					$_SESSION['s_admingroupsid']='';
					checkiillog();
				}
			}
		}
	}
    
	if($_SESSION['admincp_iillog']){
		$iillog = '# '.$_SESSION['admincp_iillog'];
	}
	include ADMIN_TPL.'login.htm';
	output();
}


if(empty($act)) {
	
	if($frameact != ''){
		parse_str($_SERVER['QUERY_STRING'], $getlinks);
		$stringlink = $pam = '';
		foreach($getlinks as $key => $value) {
			if($key == 'frameact') {
				$key = 'act';
			}
			$stringlink .= $pam.$key.'='.rawurlencode($value);
			$pam = '&';
		}
	}else{
		$stringlink = 'act=main';
	}
	include(ADMIN_TPL.'frame.htm');
	output();
}else{
	 
	if ($act == 'main') {
		require DIR_dzsw.'admin/main.php';
	} elseif($act == 'settings') {
		require DIR_dzsw.'admin/settings.php';
	} elseif($act == 'classes') {
		require DIR_dzsw.'admin/classes.php';
	} elseif($act == 'shipping') {
		require DIR_dzsw.'admin/shipping.php';
	} elseif($act == 'payment') {
		require DIR_dzsw.'admin/payment.php';
	} elseif($act == 'customers') {
		require DIR_dzsw.'admin/customers.php';
	} elseif($act == 'admin') {
		require DIR_dzsw.'admin/admin.php';
	} elseif($act == 'orders') {
		require DIR_dzsw.'admin/orders.php';
	} elseif($act == 'style') {
		require DIR_dzsw.'admin/style.php';
	} elseif($act == 'template') {
		require DIR_dzsw.'admin/template.php';
	} elseif($act == 'products') {
		require DIR_dzsw.'admin/products.php';
	} elseif($act == 'group_admin') {
		require DIR_dzsw.'admin/group_admin.php';
	} elseif($act == 'group_customers') {
		require DIR_dzsw.'admin/group_customers.php';
	} elseif($act == 'database') {
		require DIR_dzsw.'admin/database.php';
	} elseif($act == 'renzheng') {
		require DIR_dzsw.'admin/renzheng.php';
	} elseif($act == 'updatecache' || $act == 'logout') {
		require DIR_dzsw.'admin/misc.php';
	} elseif($act == 'mail') {
		require DIR_dzsw.'admin/mail.php'; 			
	} elseif($act == 'adminchangepw') {
		require DIR_dzsw.'admin/adminchangepw.php'; 	
	} elseif($act == 'news') {
		require DIR_dzsw.'admin/news.php'; 	
	} elseif($act == 'lossremark') {
		require DIR_dzsw.'admin/lossremark.php'; 	
	} elseif($act == 'gbook') {
		require DIR_dzsw.'admin/gbook.php'; 	
	} elseif($act == 'links') {
		require DIR_dzsw.'admin/links.php'; 	 	
	}
}

output();

function checkiillog($time = 4, $iiltime = 90){
	global  $timestamp, $lang_a_login;
	if($_SESSION['admincp_iillog'] > $time){
		if(($_SESSION['admincp_iiltime'] + $iiltime) > $timestamp){
			admin_msg($lang_a_login['message_illmore']);
        }else{
			$_SESSION['admincp_iillog'] = '';
		}
	}
}
