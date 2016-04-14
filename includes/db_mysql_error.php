<?php

/*----------------------------------------------------
	[dzsw] includes/db_mysql_error.php 

----------------------------------------------------*/

if(!defined('DIR_dzsw')) {
    exit('Access Denied');
}
global $timestamp, $settings;
$dberror = $this->error();
$dberrno = $this->errno();

if($dberrno == 1114) {

?>
<html>
<head>
<style type="text/css">
body{ 
	scrollbar-base-color: #32679D; 
	scrollbar-arrow-color: #C3D2E9; 
	font-size: 12px; 
	background-color: #FFB202;
	margin: 6px;
}
table{ 
	font-family: Tahoma, Verdana; 
	color: #000000; 
	font-size: 12px 
}
.tableout{ 
	background: #4277AD; 
	border: 0px solid #7CA5DE;
}
.bgcolor1{
	background-color : #FFFFFF;
}
</style>
<title>Max onlines reached</title>
</head>
<body leftmargin="6" topmargin="6">
<table bgcolor="#FFFFFF" bordercolor="#FFFFFF" width="88%" cellpadding="1" cellspacing="6" border="1" align="center" height="100%">
<tr>
	<td height="100%">

		<table cellpadding="4" cellspacing="1" border="0" width="500" align="center" class="tableout">
		<tr class="bgcolor1">
			<td>
				<br>
					<b style="font-size: 13px;">
					Notice: WebShop onlines reached the upper limit.
					</b>
					<br>
					<br>
					<br>
					Sorry, the number of online visitors has reached the upper limit.
					<br>
					Please wait for someone else going offline or visit us in idle hours.
					<br>
					<br>
	
			</td>
		</tr>
		</table>

	</td>
</tr>
</table>
</body>
</html>
<?
	exit;

} else {

?>
<html>
<head>
<style type="text/css">
body{ 
	scrollbar-base-color: #32679D; 
	scrollbar-arrow-color: #C3D2E9; 
	font-size: 12px; 
	background-color: #FFB202;
	margin: 6px;
}
table{ 
	font-family: Tahoma, Verdana; 
	color: #000000; 
	font-size: 12px 
}
.tableout{ 
	background: #4277AD; 
	border: 0px solid #7CA5DE;
}
.bgcolor1{
	background-color : #FFFFFF;
}
</style>
<title>Mysql error!</title>
</head>
<body leftmargin="6" topmargin="6">
<table bgcolor="#FFFFFF" bordercolor="#FFFFFF" width="100%" cellpadding="1" cellspacing="6" border="1" align="center" height="100%">
<tr>
	<td height="100%">
		<table cellpadding="4" cellspacing="1" border="0" width="500" align="center" class="tableout">
		<tr class="bgcolor1">
			<td>
				<br><font style="font-size: 13px;">

				<b>Time：</b> <?=gmdate("Y-n-j H:i:s", $timestamp + ($settings['time_offset'] * 3600))?><br><br>
				<b>Script: </b> <?php echo $GLOBALS['_SERVER']['REQUEST_URI'];?><br><br>
				<?if($sql){?>
					<b>SQL: </b> <?=htmlspecialchars($sql)?><br><br>
				<?}?>
				<b>Error: </b> <?=$dberror?><br><br>
				<b>Errno: </b> <?=$dberrno?><br><br>
				</font><br>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>
<?
exit;
}
?>
