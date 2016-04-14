<?php

/*----------------------------------------------------
	[dzsw] includes/upload.php 

----------------------------------------------------*/

class upload{    

	var $filename				='';
	var $extension				= '';
	var $_filename				='';

	var $cls_filename			='';
	var $cls_tmp_filename		= "";       
    var $cls_max_filesize		= 33554432; 
	var $cls_filesize			= "";  
	var $cls_filetype			= '';     
	
	var $cls_upload_dir_common	= '';
	var $cls_upload_dir_small	= '';
	var $cls_upload_dir_small2	= '';
	
	var $message				= array(); 
	var $cls_arr_ext_accepted	= array(".gif", ".jpg", ".jpeg", ".png" );

	function parse($file_name, $dir, $key = '') {
		if(isset($key)){
			$cls_tmp_filename = $_FILES[$file_name]['tmp_name'][$key];
		}else{
			$cls_tmp_filename = $_FILES[$file_name]['tmp_name'];
		}
		if(is_uploaded_file($cls_tmp_filename)){
			$this->cls_tmp_filename = $cls_tmp_filename;
        }else {
			return false;
        }

		if(isset($key)){
			$result = $this->checkextension($_FILES[$file_name]['name'][$key]);
		}else{
			$result = $this->checkextension($_FILES[$file_name]['name']);
		}
  		if( $result != 1){
			$this->message[] = 'The file could not be uploaded, this type of file is not accepted';
			return false;
		}
		
		if(isset($key)){
			$result = $this->checksize($_FILES[$file_name]['size'][$key]);
		}else{
			$result = $this->checksize($_FILES[$file_name]['size']);
		}
		if( $result != 1){
			$this->message[]='The file could not be uploaded, this file is too big';
			return false;
		}

		$result = $this->setdir($dir);
		if( $result != 1){
			$this->message[] = 'The file could not be uploaded, the directory is not writable';
			return false;
		}  

		if(isset($key)){
			$this->cls_filetype = $_FILES[$file_name]['type'][$key];
		}else{
			$this->cls_filetype = $_FILES[$file_name]['type'];
		}
		return true;
	}

	function setdir( $path ){
		global $settings;
		$path_common = DIR_dzsw.'upload/common/'.$path;
		mkdir_recursive($path_common);
		if( !is_writable( $path_common ) ){
			$this->message[] = 'The file could not be uploaded, the directory "'.$path_common.'" is not writable';
			$result = 0;
		} else { 
			$this->cls_upload_dir_common = $path_common.'/';
			$result = 1;
		}

		if($settings['smallimage_width'] >0){
			$path_small = DIR_dzsw.'upload/small/'.$path;
			mkdir_recursive($path_small);
			if( !is_writable( $path_small ) ){
				$this->message[] = 'The file could not be uploaded, the directory "'.$path_small.'" is not writable';
				$result = 0;
			} else { 
				$this->cls_upload_dir_small = $path_small.'/';
				$result = 1;
			}
		}
		if($settings['smallimage_width2'] >0){
			$path_small2 = DIR_dzsw.'upload/small2/'.$path;
			mkdir_recursive($path_small2);
			if( !is_writable( $path_small2 ) ){
				$this->message[] = 'The file could not be uploaded, the directory "'.$path_small2.'" is not writable';
				$result = 0;
			} else { 
				$this->cls_upload_dir_small2 = $path_small2.'/';
				$result = 1;
			}
		}
		return $result;
	}

	function checkextension($cls_filename){
  		if( !in_array( strtolower( strrchr( $cls_filename, "." )), 				$this->cls_arr_ext_accepted )){
			return 0;
		} else {
			$this->cls_filename = $cls_filename;
			return 1;
		}
	}

	function checksize($file_size){
		if( $file_size > $this->cls_max_filesize ){
			return 0;
		} else {
			return 1;
		}
	}

	function move(){
		$this->extension = strtolower( strrchr( $this->cls_filename, "." ));
		$this->filename = $this->_filename.$this->extension;
		
		if( move_uploaded_file( $this->cls_tmp_filename, $this->cls_upload_dir_common . $this->filename ) == false ){
			return 0;
		} else {
			return 1;
		}
	}
	function create_small_image(){
		global $settings;
		if($settings['create_smallimage'] == 'true' && function_exists(imageline)){
			if($settings['smallimage_width'] >0 || $settings['smallimage_width2'] > 0){
				if($this->cls_filetype == "image/pjpeg"){
					$im = @imagecreatefromjpeg($this->cls_tmp_filename);
				}elseif($this->cls_filetype == "image/x-png"){
					$im = @imagecreatefrompng($this->cls_tmp_filename);
				}elseif($this->cls_filetype == "image/gif"){
					$im = @imagecreatefromgif($this->cls_tmp_filename);
				}
			}
			if($settings['smallimage_width'] >0 && $im){
				$this->ResizeImage($im,$settings['smallimage_width'],'',$this->cls_upload_dir_small.$this->_filename);
			}
			if($settings['smallimage_width2'] >0 && $im){				  
				$this->ResizeImage($im,$settings['smallimage_width2'],'',$this->cls_upload_dir_small2.$this->_filename);
			}
			@ImageDestroy ($im);
		} 
	}

	function save($createsmall = 0, $new_name = ''){

		$this->_filename = $new_name;
		if($createsmall){
			$ret_create_small_image = $this->create_small_image();
		}
		$ret_move = $this->move();
		if($ret_move != 1){
			$this->message[] = 'The file could not be uploaded, the file could not be copied to destination directory';
			return  false;  
		}
	}

	function ResizeImage($im,$maxwidth,$maxheight = '',$name){
		$width = @imagesx($im);
		$height = @imagesy($im);
		if($maxwidth && $width > $maxwidth){
            $RESIZEWIDTH = false;
			if($maxwidth && $width > $maxwidth){
                $widthratio = $maxwidth/$width;
                $RESIZEWIDTH = true;
            }
            if($RESIZEWIDTH){
                $ratio = $widthratio;
            }

            $newwidth = $width * $ratio;
            $newheight = $height * $ratio;
            if(function_exists("imagecopyresampled")){
                 $newim = imagecreatetruecolor($newwidth, $newheight);
                 imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            }else{
                 $newim = imagecreate($newwidth, $newheight);
                 imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            }
            ImageJpeg ($newim,$name . ".jpg");
            ImageDestroy ($newim);
		}else{
            ImageJpeg ($im,$name . ".jpg");
		}
	}
}
