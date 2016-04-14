<?php

/*---------------------------------------------------
	[dzsw] showimg.php 

---------------------------------------------------*/

define('CURRSCRIPT','img_small');

require('includes/global.php');

if (strstr($_SERVER[HTTP_USER_AGENT], "MSIE")) {
	$attachment = '';
} else {
	$attachment = ' atachment;';
} 

if(!$id){
     exit("error!");
}

$get_one = $db->get_one("select path, name, extension from $table_source where id='".$id."' order by id limit 1");

$extension = $get_one['extension'];

if($type == 'small' && $settings['smallimage_width'] >0 && $settings['smallimage_width'] >0 && is_numeric($settings['smallimage_width']) && $settings['create_smallimage'] == true){
    $filename = DIR_dzsw.'upload/small/'.$get_one['path'].'/'.$get_one['name'].'.jpg';
}elseif($type == 'small2' && $settings['smallimage_width2'] >0 && $settings['smallimage_width2'] >0 && is_numeric($settings['smallimage_width2'])  && $settings['create_smallimage'] == true){
    $filename = DIR_dzsw.'upload/small2/'.$get_one['path'].'/'.$get_one['name'].'.jpg';
}else{
	$filename = DIR_dzsw.'upload/common/'.$get_one['path'].'/'.$get_one['name'].$extension;
}

if (!file_exists($filename)) {
     $filename = DIR_dzsw.$styles['imgdir']."/nopicture.gif";
	 $extension = '.gif';
} 

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

if ($extension=='.gif') {
    header('Content-type: image/gif');
} elseif ($extension=='.jpg' or $extension=='.jpeg') {
    header('Content-type: image/jpeg');
} elseif ($extension=='.png') {
    header('Content-type: image/png');
} else {
    header('Content-type: unknown/unknown');
}
      
header("Content-disposition:$attachment filename=$get_one[name]");

$size = @filesize($filename);

header("Content-type: $image[type]");
header("Content-Length: $size");

$fd = fopen($filename, rb);
$contents = fread($fd, $size);
fclose ($fd);

echo $contents;

?>