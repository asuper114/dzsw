<?php
/*----------------------------------------------------
	[dzsw] languages/faq_payment.php

----------------------------------------------------*/
if(in_array('goodsarrivepay',$faq_payment_body) && $googsself_city ){
	$faq_message['payment'][]='
		<ul>
			<li>目前我们开通了以下城市的送货上门货到付款服务：'.$googsself_city.'</li>
		</ul>	
		<ul>
			<li>注意事项：
				<ul>
					<li>货到付款方式对应的配送方式为送货上门。 </li>
                </ul>
			</li>
		</ul>						 
	';
}

if(in_array('postpay',$faq_payment_body)){
	$faq_message['payment'][]='
		<ul>
			<li>汇款信息
				<ul>
               		<li>'.$payment_a_postpay['address']['title'].$payment_a_postpay['address']['value'].'
					</li>
                  	<li>'.$payment_a_postpay['postcode']['title'].$payment_a_postpay['postcode']['value'].'
					</li>
                  	<li>'.$payment_a_postpay['manname']['title'].$payment_a_postpay['manname']['value'].'
					</li>
                </ul>
			</li>
			<li> 注意事项
				<ul>
					<li>
						为了在收到您的汇款单时可以准确的处理您的订单，请在汇款附言处填写您的订单号码。如果您不注明您的订单号码，我们将无法将该汇款输入到您的账户中去，导致你所订购的商品无法收到。 
					</li>
					<li>请您不要在填写订单内容时使用汉语拼音，如姓名、地址等</li>
				</ul>
			</li>
			<li> 汇单范例
				<br />
				<a href="images/common/post.gif" target="_blank"><img src="images/common/post.gif"  border="0"></a>
			</li>
		</ul>
	';
}

if(in_array('banktransfer',$faq_payment_body)){          

	$faq_message['payment'][]='
		<ul>
			<li>汇款账号
				<ol>
				'.$faq_message_payment_banktransfer.'
				</ol>
			</li>
			<li>注意事项
				<ol>
					<li>适用于全国范围，到款时间24小时内；</li>
					<li>请在提交订单后尽快办理汇款手续；</li>
					<li>任何银行都可以向此种卡里汇款；</li>
					<li>汇款金额必须与订单金额一致；</li>
					<li>汇款后请您通过电话、邮件或传真等方式与我们的客服联系确认款项，以便尽快为您处理订单。</li>
				</ol>
			</li>
		<ul>			
	';
}
if(in_array('online',$faq_payment_body)){ 
   $faq_message['payment'][]='
		<ol>
			<li>
				银行卡网上在线支付包括国际、国内信用卡、借记卡等。如：建行、工行、招行、农行、 VISA、 万事达MasterCard、美国运通卡AE等等
			</li>
			<li>
				如果您还没有相关银行网上支付的功能,一般情况下，请先申请，然后才可以进行网上支付（个别银行在某些地区可能已经不需要申请了）。
			</li>			
			<li>
				如何申请，可以看相关银行的演示说明或者电话咨询当地银行，然后按照引导一步步的操作就可以了。
				<br />有些初次使用网上支付的用户可能会遇到一些问题，可能会感觉有些麻烦和困惑。别着急，一开始都会有这样的感觉，请耐心按照提示一步步的操作，多尝试并取得所有您能得到的帮助，相信最终您能和大家一样顺利在网上支付。申请成功后，再次在网上支付就会真的很方便，你就能体验到网上购物的快捷了。
			</li>
			<li>
				申请完成之后如果找不到刚才您的购物车了，可去 '.$settings['store_name'].' 首页左上方点击“购物车”，系统会自动为您保留您购物车的商品等信息，您还可以继续开始支付的过程。
			</li>			
			<li>
				您可以通过“提交订单”后的“提交成功” 页下方银行卡支付入口进行网上支付。
			</li>			
			<li>
				如果您当时不方便支付或者在支付过程中遇到一些问题，您还可以去“我的帐户”中找到您的定单，然后，点击“详情” ，在定单详细信息页面的‘付款方式’处，我们还为您保留着相关银行的网上支付入口，您也可以在这里进行网上支付。
			</li>
			<li>
				如果您申请成功后，也进行网上支付了，但是因为某种原因没有支付成功，您还可以去“我的帐户”里修改付款方式，尝试其他您更方便的支付方式。
			</li>
			<li> 
				使用网上支付安全吗？
              	<ul>
					<li>
						网上支付是通过国内各大银行的支付网关进行操作的，采用的是国际流行的SSL或SET方式加密。安全性是由银行方面负责的，是完全有保证的。当用户需要填写信用卡资料时，实际上已经到达到银行的支付网关。所以，用户不必担心您的信用卡资料会在其它地方泄露。请用户不要在公共场合输入信用卡信息，以防被他人看到您的卡号及密码。如果您需要得到更多与“网上支付安全”方面的信息，请您直接与您的发卡行联系或访问您的发卡行的网站或得当关信息。
					</li>
				</ul>
			</li>
		</ol>
	';
}
?>

