<?php

/*----------------------------------------------------
	[dzsw] modules/payment/westpay_form.php

	Version: 1.5
	
	
	Last Modified: 2006/3/11 10:00

----------------------------------------------------*/
    
$form_info[form_action]	=	'http://www.WestPay.com.cn/Pay/WestPayReceiveOrderFromMerchant.asp';
$form_info[hidden]		=	'<input name="OrderAmount" value="'.$pay_total.'" type="hidden">'. // 订单总金额
							'<input name="OrderNumber" value="'.$timestamp.'_'.$order_data['orders_id'].'" type="hidden">'.   // 订单编号
							'<input name="MerchantID" value="'.$cache_payment[$order_data['payment_method']]['pa']['account']['value'].'" type="hidden">'. //商户编号 
							'<input name="PostBackURL" value="'.$settings[storeurl].'/get_onlinepay.php?paytype=westpay" type="hidden">' //支付动作完成后返回到该url，支付结果以GET方式发送
						;
//$form_info[title]		=	$payment_title;												

?>
