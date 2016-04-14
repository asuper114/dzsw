<?php

$db->query("DELETE FROM ".$table_pre."admins");
$db->query("INSERT INTO ".$table_pre."admins (email, password, adminid, admingroupsid, createdate, lastvisit)
	 VALUES ('$email', '".md5($password)."', '1', '1', '".$timestamp."', '".$timestamp."');");
?>