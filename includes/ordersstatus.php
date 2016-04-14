<?php
/*----------------------------------------------------
	[dzsw] includes/ordersstatus.php 

----------------------------------------------------*/

$orders_status_array	=	array();
$orders_status_array['noauditing']	=	array(	
	'title' => $lang_orderstatus['noauditing'],
	'show'	=> array('auditing','cancel')
);

$orders_status_array['auditing']	=	array(	
	'title' => $lang_orderstatus['auditing'],
	'show'	=> array('waitforpay','shipping'),
	'email'	=> $lang_orderstatus['email_auditing'],
);

$orders_status_array['waitforpay']	=	array(	
	'title' => $lang_orderstatus['waitforpay'],
	'show'	=> array('partpay','allpay'),
	'email'	=> $lang_orderstatus['email_waitforpay'],
);

$orders_status_array['partpay']		=	array(	
	'title' => $lang_orderstatus['partpay'],
	'show'	=> array('allpay'),
	'email'	=> $lang_orderstatus['email_partpay'],
);

$orders_status_array['allpay']		=	array(	
	'title' => $lang_orderstatus['allpay'],
	'show'	=> array('makesurepay'),
	'email'	=> '',
);

$orders_status_array['makesurepay']=	array(	
	'title' => $lang_orderstatus['makesurepay'],
	'show'	=> array('shipping','waitforsend','partsend','allsend'),
	'email'	=> $lang_orderstatus['email_allsend'],
);

$orders_status_array['cancel']		=	array(	
	'title' => $lang_orderstatus['cancel'],
	'show'	=> array('payback'),
);

$orders_status_cancel = array();
$orders_status_cancel[]	=	array(	
	'title' => $lang_orderstatus['cancel_1'],
	'email' => $lang_orderstatus['email_cancel_1'],
);

$orders_status_cancel[]	=	array(	
	'title' => $lang_orderstatus['cancel_2'],		
	'email' => $lang_orderstatus['email_cancel_2'],
);

$orders_status_cancel[]	=	array(	
	'title' => $lang_orderstatus['cancel_3'],
	'email' => $lang_orderstatus['email_cancel_3'],
);

$orders_status_array['cancel']['sub'] = $orders_status_cancel;

$orders_status_array['shipping']	=	array(	
	'title' => $lang_orderstatus['shipping'],
	'show'	=> array('waitforsend','partsend','allsend')
);

$orders_status_array['waitforsend']	=	array(	
	'title' => $lang_orderstatus['waitforsend'],
	'show'	=> array('partsend','allsend')
);

$orders_status_array['partsend']	=	array(	
	'title' => $lang_orderstatus['partsend'],
	'show'	=> array('allsend','getexchange'),
	'email' => $lang_orderstatus['email_partsend'],
);

$orders_status_array['allsend']		=	array(	
	'title' => $lang_orderstatus['allsend'],
	'show'	=> array('sendsuccess','sendfail'), 
	'email'	=> $lang_orderstatus['email_allsend'],
);

$orders_status_array['sendsuccess']		=	array(	
	'title' => $lang_orderstatus['sendsuccess'],
	'show'	=> array('over'), 
	'email'	=> $lang_orderstatus['email_sendsuccess'],
);
$orders_status_array['sendfail']		=	array(	
	'title' => $lang_orderstatus['sendfail'],
	'show'	=> array('waitforsend','payback'), 
	'email'	=> $lang_orderstatus['email_sendfail'],
);

$orders_status_array['over']		=	array(	
	'title' => $lang_orderstatus['over'],
	'show'	=> array('getexchange'), 
	'email'	=> '',
);

$orders_status_array['getexchange']	=	array(	
	'title' => $lang_orderstatus['getexchange'],
	'show'	=> array('payback'),
	'email'	=> $lang_orderstatus['email_getexchange'],
);

$orders_status_array['payback']		=	array(	
	'title'	=> $lang_orderstatus['payback'],
	'show'	=> array(),
	'email'	=> $lang_orderstatus['email_payback'],
);
