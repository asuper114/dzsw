<?php

/*----------------------------------------------------
	[dzsw] admin/settings.php 

------------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($admingroupsid != '1'){
    admin_msg($lang_a_common['forbid']);
}

function settings_styles($style_id, $key = '') {
   	global $db,$table_styles;
	$stylelist = "<select name=\"settings_add[" . $key . "]\">\n";
	$query = $db->query("SELECT styleid, title FROM $table_styles");
	while($style = $db->fetch_array($query)) {
		$selected = $style[styleid] == $style_id ? "selected=\"selected\"" : NULL;
		$stylelist .= "<option value=\"$style[styleid]\" $selected>$style[title]</option>\n";
	}
	$stylelist .= "</select>";
	return ($stylelist);
}

function settings_country_default($c_id, $key = '') {
   	global $db,$table_area;
	$c_list = "<select name=\"settings_add[". $key ."]\">\n";
	$query = $db->query("SELECT * FROM $table_area where parentid ='0'");
	while($area = $db->fetch_array($query)) {
		$selected = $area['id'] == $c_id ? "selected=\"selected\"" : NULL;
		$c_list .= "<option value=\"$area[id]\" $selected>$area[name]</option>\n";
	}
	$c_list .= "</select>";
	return $c_list;
}

function settings_radio($select_array, $value, $key = '') {
	$string = '';
	for ($i=0, $n=sizeof($select_array); $i<$n; $i++) {
		$string .= '<input type="radio" name="settings_add[' . $key . ']" value="' . $select_array[$i] . '"';
		if ($value == $select_array[$i]) $string .= ' CHECKED';
		$string .= '> ' . $select_array[$i];
    }
    return $string;
}

function settings_radio_more($select_array, $value, $key = '') {
	$string = '';
	for ($i=0, $n=sizeof($select_array); $i<$n; $i++) {
		$string .= '<input type="radio" name="settings_add[' . $key . ']" value="' . $select_array[$i]['k'] . '"';
		if ($value == $select_array[$i]['k']) $string .= ' CHECKED';
		$string .= '> ' . $select_array[$i]['name'].'<br />';
    }
    return $string;
}

if(!$action){

	$query = $db->query("select settings_id, settings_key, value, set_function from $table_settings where group_id = '" . (int)$group_id . "' order by sort_order");
    while ($settings = $db->fetch_array($query)) {
		if($group_id == 4 && $settings['settings_key'] == 'date_format'){
			$settings['value'] = str_replace('m', 'mm', $settings['value']);
			$settings['value'] = str_replace('d', 'dd', $settings['value']);
			$settings['value'] = str_replace('y', 'yy', $settings['value']);
			$settings['value'] = str_replace('Y', 'yyyy', $settings['value']);
		}
		if ($settings['set_function']) {
			eval('$value_field = ' . $settings['set_function']. '"' . htmlspecialchars($settings[value]) . '","'.$settings[settings_key].'");');
		}else {
			if($settings['settings_key']=='store_description' || $settings['settings_key'] == 'seo_othor'){
				$value_field = '<textarea name="settings_add['.$settings[settings_key].']" rows="7" cols="50">'.$settings[value].'</textarea>';
			}elseif($settings['settings_key'] == 'picture_savepath'){
				$_array_ = array();
				$_array_[] = array(
					'k'		=> 'default',
					'name'	=> $lang_settings['setting_picture_savepath_default'],
				);
				$_array_[] = array(
					'k'		=> 'byday',
					'name'	=> $lang_settings['setting_picture_savepath_byday'],
				);
				$value_field = settings_radio_more($_array_, $settings['value'], $settings['settings_key']);
			
			}else{
				$value_field = "<input type=\"text\" size=\"40\" name=\"settings_add[".$settings['settings_key']."]\" value=\"".$settings['value']."\">";
			}
		}
		$settings['value_field'] = $value_field;
		$settings['settingsname'] = 'setting_'.$settings['settings_key'];
		$settings['description'] = 'setting_'.$settings['settings_key'].'_desc';
		$settings_all[] = $settings;
    }
    include ADMIN_TPL.'settings.htm';

}else{
	if($group_id == '4'){
		$settings_add['date_format'] = str_replace('mm', 'm', $settings_add['date_format']);
		$settings_add['date_format'] = str_replace('dd', 'd', $settings_add['date_format']);
		$settings_add['date_format'] = str_replace('yyyy', 'Y', $settings_add['date_format']);
		$settings_add['date_format'] = str_replace('yy', 'y', $settings_add['date_format']);
	}
	foreach($settings_add as $key=>$val){
		$db->query("update $table_settings set value = '$val' where settings_key = '" . $key . "'");
    }
    updatecache();
	admin_msg($lang_a_message['update_success'],'admin.php?act=settings&group_id='.$group_id); 
}

?>
