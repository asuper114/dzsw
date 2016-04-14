<?php
/*----------------------------------------------------
	[dzsw] includes/sendmail.php 

----------------------------------------------------*/

Class shop_mail
{
	var $email_from_all	= ''; 
	var $email_from			= ''; 
	var $headers			= ''; 
	
	var $other_fp			= ''; 
	var $other_host			= ''; 
	var $other_port			= ''; 
	var $other_auth			= ''; 
	var $other_from			= ''; 
	var $other_username		= ''; 
	var $other_password		= '';

	function shop_mail($toaddress,$subject = '', $message, $fromaddress = ''){
		global $settings;

		$this->email_from_all = $settings['store_name'].'<'.$settings['email_from'].'>';
		$this->email_from = $settings['email_from'];

		$this->headers = '';
		$this->headers .= "MIME-Version: 1.0\r\n";
		$this->headers .= "Content-type: text/html; charset=gb2312\r\n";	

		$message = str_replace("\r", '', $message);
		
		if($settings['email_transport'] == 'sendmail'  && function_exists('mail'))
		{
			$this->sendmail_model($toaddress, $subject, $message);

		}
		elseif($settings['email_transport'] == 'smtp')
		{
			@ini_set('SMTP', $settings['email_smtp_host']);	
			@ini_set('smtp_port', $settings['email_smtp_port']);	
			@ini_set('sendmail_from', $this->email_from);
			$this->smtp($toaddress, $subject, $message);

		}
		elseif($settings['email_transport'] == 'other')
		{
			$this->other_host		= $settings['email_othor_host'];
			$this->other_port		= $settings['email_othor_port'];
			$this->other_auth		= $settings['email_othor_auth'];
			$this->other_from		= $settings['email_othor_from'];
			$this->other_username	= $settings['email_othor_username'];
			$this->other_password	= $settings['email_othor_password'];

			$this->other($toaddress, $subject, $message);
		}
	}

	function sendmail_model($toaddress, $subject, $message){

		if(strpos($toaddress, ','))
		{
			@mail('dzsw Customers <me@localhost>', $subject, $message, $this->headers."From: ".$this->email_from_all."\r\nBcc: $toaddress");
		}
		else
		{
			@mail($toaddress, $subject, $message, $this->headers."From: ".$this->email_from_all);
		}
	}

	function smtp($toaddress, $subject, $message){

		@mail($toaddress, $subject, $message, $this->headers."From: ".$this->email_from_all);

	}

	function other($toaddress, $subject, $message){

		$this->other_fp = @fsockopen($this->other_host, $this->other_port, $errno, $errstr, 30);
		if(!$this->other_fp)
		{
			$_smail = array(
				'msg'		=> 'Failed to connect to server('.$this->other_host.':'.$this->other_port.')',
			);
			$this->maillog($_smail);
		}
		else
		{
			$get_fp_msg = $this->other_message();
			if(substr($get_fp_msg, 0, 3) != '220') {
				$_smail = array(
					'msg'		=> 'Get reply: '.$get_fp_msg.' when connect to the server('.$this->other_host.':'.$this->other_port.')',
				);
				$this->maillog($_smail);
			}
			
			$auth_word = $this->other_auth ? 'EHLO' : 'HELO';
			fputs($this->other_fp, $auth_word." dzsw\r\n");
			$get_fp_msg = $this->other_message();
			if(substr($get_fp_msg, 0, 3) != 220 && substr($get_fp_msg, 0, 3) != 250) {
				$_smail = array(
					'msg'		=> 'Get reply: '.$get_fp_msg.' when '.$auth_word.' to the server('.$this->other_host.':'.$this->other_port.')',
				);
				$this->maillog($_smail);
			}

			while(1) {
				$get_fp_msg = $this->other_message();
				if(substr($get_fp_msg, 3, 1) != '-' || empty($get_fp_msg)) {
					break;
				}
			} 

			if($this->other_auth == 'true') {
				fputs($this->other_fp, "AUTH LOGIN\r\n");
				$get_fp_msg = $this->other_message();
				if(substr($get_fp_msg, 0, 3) != 334) {
					$_smail = array(
						'msg'		=> 'Get reply: '.$get_fp_msg.' when AUTH LOGIN to the server('.$this->other_host.':'.$this->other_port.')',
					);
					$this->maillog($_smail);
				}

				fputs($this->other_fp, base64_encode($this->other_username)."\r\n");
				$get_fp_msg = $this->other_message();
				if(substr($get_fp_msg, 0, 3) != 334) {
					$_smail = array(
						'msg'		=> 'Get reply: '.$get_fp_msg.' when put USERNAME to the server('.$this->other_host.':'.$this->other_port.')',
					);
					$this->maillog($_smail);
				}

				fputs($this->other_fp, base64_encode($this->other_password)."\r\n");
				$get_fp_msg = $this->other_message();
				if(substr($get_fp_msg, 0, 3) != 235) {
					$_smail = array(
						'msg'		=> 'Get reply: '.$get_fp_msg.' when put PASSWORD to the server('.$this->other_host.':'.$this->other_port.')',
					);
					$this->maillog($_smail);
				}
			}

			$this->other_from = ($this->other_auth == 'true') ? $this->other_from : $this->email_from;

			fputs($this->other_fp, "MAIL FROM: ".$this->other_from."\r\n");
			$get_fp_msg = $this->other_message();
			if(substr($get_fp_msg, 0, 3) != 250) {
				fputs($this->other_fp, "MAIL FROM: <".$this->other_from.">\r\n");
				$get_fp_msg = $this->other_message();
				if(substr($get_fp_msg, 0, 3) != 250) {
					$_smail = array(
						'msg'		=> 'Get reply: '.$get_fp_msg.' when put MAIL FROM to the server('.$this->other_host.':'.$this->other_port.')',
					);
					$this->maillog($_smail);
				}
			}

			foreach(explode(',', $toaddress) as $touser) {
				$touser = trim($touser);
				if($touser) {
					fputs($this->other_fp, "RCPT TO: $touser\r\n");
					$get_fp_msg = $this->other_message();
					if(substr($get_fp_msg, 0, 3) != 250) {
						fputs($this->other_fp, "RCPT TO: <$touser>\r\n");
						$get_fp_msg = $this->other_message();
						$_smail = array(
							'msg'		=> 'Get reply: '.$get_fp_msg.' when put RCPT TO to the server('.$this->other_host.':'.$this->other_port.')',
						);
						$this->maillog($_smail);
					}
				}
			}

			fputs($this->other_fp, "DATA\r\n");
			/*
			if(strpos($toaddress, ','))
			{
				$this->headers .= "To: <me@localhost>\r\nFrom: ".$this->email_from_all."\r\nSubject: ".str_replace("\n", ' ', $subject)."\r\n\r\n$message\r\n.\r\n";
			}
			else
			{*/
				$this->headers .= "To: $toaddress\r\nFrom: ".$this->email_from_all."\r\nSubject: ".str_replace("\n", ' ', $subject)."\r\n\r\n$message\r\n.\r\n";
			//}
			fputs($this->other_fp, $this->headers); 
			fputs($this->other_fp, "QUIT\r\n");
		}
	}

	/*
	$_smail = array(
		'type'		=> '',
		'msg'		=> '',
	);
	*/
	function maillog($_smail) {
		global $timestamp, $settings;
		$_smail['type'] = $_smail['type'] != '' ? $_smail['type'] : 'other';	
		$_smail['msg'] = str_replace(array("\r", "\n"), array(" ", " "), trim(shtmlspecialchars($_smail['msg'])));
		$format_time = gmdate($settings['date_format'].' H:i:s', $timestamp+ $settings['time_ofset'] * 3600);
		writefile(DIR_dzsw.'data/log/','mail_'.$_smail['type'].'.php',"$timestamp\t$format_time\t".$_smail['msg']."\n");
	}

	function other_message() {
		//$data = "";
		$data = fgets($this->other_fp,515);
		/*
		while($str = fgets($this->other_fp,515)) {
			$data .= $str;
			if(substr($str,3,1) == " ") { 
				break; 
			}
		}
		*/
		return $data;
	}
}
