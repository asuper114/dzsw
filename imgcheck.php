<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

$imgnum=random(4); 
$_SESSION['imgnum'] = $imgnum;
createimg($imgnum,50,20);

function random($leng) {
	 $text = '';
	 $var = md5('0123456789');
	 $max = strlen($var) - 1;
	 mt_srand((double)microtime() * 1000000);
	 for($i = 0; $i < $leng; $i++) {
	    $text .= $var[mt_rand(0, $max)];
	 }
	 return $text;
}

function createimg($str="",$width=150,$height=30){
	//echo 'here';
	if(function_exists("imagecreate")){
		$im = imagecreate($width, $height);
		//echo 'rigth here';
	}else{
		//echo 'err here';
		return false;
	}
	
	$back = imagecolorallocate($im,0xFF,0xFF,0xFF);
	$pix = imagecolorallocate($im,0x68,0x80,0x38);
	$font = imagecolorallocate($im,0x68,0x80,0x38);
	mt_srand();
	for($i=0;$i<100;$i++){
		@imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pix);
	}

	imagerectangle($im,0,0,$width-1,$height-1,$font);

	for ($i=0;$i<strlen($str);$i++){ 
		imageString($im,5,$i*$width/4+3,2, $str[$i],$pix); 
	}
	
	header("Content-Type:image/png");
	imagepng($im);
	imagedestroy($im);
	exit;
}

?>
