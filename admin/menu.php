<?php

/*----------------------------------------------------
	[dzsw] admin/menu.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

$menu_num = 0;
function showmenu($title="",$nav=array(),$display='block') {
    global $menu_num; 
    if(is_array($nav) && !is_array($nav['0'])){
		return false;
	}
	echo "<table  border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"100%\" class=\"tableout\" align=\"center\"><tr class=\"header\"><td style=\"cursor: hand\" onClick='showHide(\"menu$menu_num\")'>$title</td></tr>\n";
	if(is_array($nav)) {
		echo '<tr id="menu'.$menu_num.'" style="display:'.$display.'" class="bgcolor1"><td><table  border="0" cellspacing="1" cellpadding="0" width="100%" align="center">';
		foreach($nav as $menu) {
			echo "<tr><td><a href=\"".$menu['url']."\" target=\"main\">".$menu['name']."</a></td></tr>\n";
		}
		echo '</table></td></tr>';
	}		 
    $menu_num++;
	echo '</table><br />';
}

include(ADMIN_TPL.'header.htm');
?>
<script language="JavaScript" type="text/javascript">
<!--
	function showHide(objname)
	{
		var obj = document.getElementById(objname);
		obj.style.display == "none" ? obj.style.display = "block" : obj.style.display = "none";
	}
-->
</script>

<?php

if($admingroupsid == '1'){
	showmenu($lang_a_menu['settings'], 
		array(
			/*array('name' => $lang_a_menu['settings_common'],	'url' => 'admin.php?act=settings&group_id=1'),
			array('name' => $lang_a_menu['settings_base'],		'url' => 'admin.php?act=settings&group_id=2'),
			array('name' => $lang_a_menu['settings_email'],		'url' => 'admin.php?act=settings&group_id=3'),
			array('name' => $lang_a_menu['settings_show'],		'url' => 'admin.php?act=settings&group_id=4'),
			array('name' => $lang_a_menu['settings_num'],		'url' => 'admin.php?act=settings&group_id=5'),
			array('name' => $lang_a_menu['settings_mark'],		'url' => 'admin.php?act=settings&group_id=6'),
			array('name' => $lang_a_menu['settings_seo'],		'url' => 'admin.php?act=settings&group_id=7'),
			array('name' => $lang_a_menu['settings_shipping'],	'url' => 'admin.php?act=shipping'),*/
			array('name' => $lang_a_menu['settings_payment'],	'url' => 'admin.php?act=payment'),
		),
		''
	);
}

if($allow_news_edit || $allow_news_add || $allow_news_delete || $admingroupsid ==1){
	showmenu(
		$lang_a_menu['news'], 
		array( 
			array('name' => $lang_a_menu['news_all'],	'url' => 'admin.php?act=news'),
			array('name' => $lang_a_menu['news_add'],	'url' => 'admin.php?act=news&type=add'),
		),
		''
	);
}

if($allow_gbook_edit || $allow_gbook_delete || $allow_gbook_reply || $admingroupsid ==1){
	showmenu(
		$lang_a_menu['gbook'], 
		array( 
			array('name' => $lang_a_menu['gbook_all'],	'url' => 'admin.php?act=gbook'),
		/*
			array('name' => $lang_a_menu['gbook_replay'],	'url' => 'admin.php?act=gbook&type=class'),
			
			array('name' => LANG_A_MENU_GBOOK_REPLYYES,	'url' => 'admin.php?act=gbook&type=replyyes'),
			array('name' => LANG_A_MENU_GBOOK_REPLYNO,	'url' => 'admin.php?act=gbook&type=replyno'),*/
		),
		''
	);
}

/*if($allow_links_edit || $allow_links_add || $allow_links_delete || $admingroupsid ==1){
	showmenu(
		$lang_a_menu['links'], 
		array( 
			array('name' => $lang_a_menu['links_all'],	'url' => 'admin.php?act=links'),
			array('name' => $lang_a_menu['links_add'],	'url' => 'admin.php?act=links&type=add'),
		),
		''
	);
}*/

if($allow_class_see || $admingroupsid ==1){
	showmenu(
		$lang_a_menu['class'], 
		array( 
			array('name' => $lang_a_menu['class_inheader'],'url' => 'admin.php?act=classes&type=showinheader'),
			array('name' => $lang_a_menu['class_add'],	'url' => 'admin.php?act=classes&type=add'),
			array('name' => $lang_a_menu['class_edit'],	'url' => 'admin.php?act=classes'),
			array('name' => $lang_a_menu['class_merge'],'url' => 'admin.php?act=classes&type=merge'),
		),
		''
	);
}

if($allow_product_see || $admingroupsid ==1){
	showmenu(
		$lang_a_menu['product'], 
		array(	
			array('name' => $lang_a_menu['lookclass'],			'url' => 'admin.php?act=products&type=class'),
			array('name' => $lang_a_menu['product_add'],		'url' => 'admin.php?act=products&type=add'),
			array('name' => $lang_a_menu['product_search'],		'url' => 'admin.php?act=products&type=search'),
			array('name' => $lang_a_menu['product_specials'],	'url' => 'admin.php?act=products&type=specials'),
		),
		''
	);
}

if($allow_order_see || $admingroupsid ==1){
	$menu_array = array();
	foreach(@array_unique(@array_merge(explode(',',$allow_orderstatus),explode(',',$allow_orderstatus_g))) as $k=>$v){
		if($v == ''){
			continue;
		}
		$menu_array[] = array(
			'name'	=> $lang_a_menu['order_'.$v],
			'url'	=> 'admin.php?act=orders&orders_status_insert='.$v,
		);
	}
	if($adminid != ''){
		$menu_array[] = array(
			'name' => $lang_a_menu['order_search'],		
			'url' => 'admin.php?act=orders&type=search'
		);
		showmenu($lang_a_menu['order'], $menu_array, '');
	}
}

if($admingroupsid == '1'){
	showmenu(
		$lang_a_menu['mark'], 
		array(	
			array(
				'name'	=> $lang_a_menu['mark_lossremark'],		
				'url'	=> 'admin.php?act=lossremark'
			),

		),
		''
	);
}

if($allow_customer_see || $admingroupsid ==1){
	showmenu(
		$lang_a_menu['customer'], 
		array( 
			array('name' => $lang_a_menu['customer_all'],	'url' => 'admin.php?act=customers&action=search'),
			array('name' => $lang_a_menu['customer_edit'],	'url' => 'admin.php?act=customers'),
		),
		''
	);
}

if($admingroupsid == '1'){
	showmenu(
		$lang_a_menu['adminer'], 
		array( 
			array(
				'name'	=> $lang_a_menu['adminer_all'], 
				'url'	=> 'admin.php?act=admin'),
			array(
				'name'	=> $lang_a_menu['adminer_add'], 
				'url'	=> 'admin.php?act=admin&type=add',
			),
		),
		''
	);
}
		
if($admingroupsid == '1'){	
	showmenu(
		$lang_a_menu['group'], 
		array( 
			array(
				'name'	=> $lang_a_menu['group_adminer'], 
				'url'	=> 'admin.php?act=group_admin',
			),
			array(
				'name'	=> $lang_a_menu['group_customer'], 
				'url'	=> 'admin.php?act=group_customers',
			),
		),
		''
	);
}


/*if($admingroupsid == '1'){
	showmenu(
		$lang_a_menu['style_template'], 
		array(	
			array(
				'name'	=> $lang_a_menu['style'],		
				'url'	=> 'admin.php?act=style'),
			array(
				'name'	=> $lang_a_menu['template'],	
				'url'	=> 'admin.php?act=template',
			),
		),
		''
	);
}


if($admingroupsid == '1'){
	showmenu(
		$lang_a_menu['database'], 
		array(	
			array(
				'name'	=> $lang_a_menu['database_update'],		
				'url'	=> 'admin.php?act=database&type=update'
			),

		),
		''
	);
}

if($admingroupsid == '1'){
	showmenu(
		$lang_a_menu['dzswset'], 
		array(	
			array(
				'name'	=> $lang_a_menu['dzswset_rzset'],		
				'url'	=> 'admin.php?act=renzheng'
			),

		),
		''
	);
}*/


$menu_array = array();
if($admingroupsid == '1'){
	$menu_array[] = array(
		'name' => $lang_a_menu['tools_updatecache'], 
		'url' => 'admin.php?act=updatecache',
	);
}
/*if($allow_sendmail || $admingroupsid == '1'){	
	$menu_array[] = array(
		'name' => $lang_a_menu['tools_sendmail'], 
		'url' => 'admin.php?act=mail',
	);
}*/
showmenu($lang_a_menu['tools'], $menu_array,'');
?>

<br />
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td>
		<hr size="0" />
		<center><font style="font-size: 11px; font-family: Tahoma, Verdana, Arial">
		Powered by <a href="http://forum.dzsw.com" target="_blank"><b> dzsw
	</td>
</tr>
</table>

</body>
</html>
