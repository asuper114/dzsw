<?php
/*----------------------------------------------------
	[dzsw] languages/defineinfo.php

----------------------------------------------------*/

$defineinfo = array();
$defineinfo['buyarticle']['title'] = $lang_defineinfo['buyarticle'];
$defineinfo['platform_desc']['title'] = $lang_defineinfo['platform_desc'];
$defineinfo['cantactus']['title'] = $lang_defineinfo['cantactus'];
		
if($type == 'buyarticle'){
	$defineinfo['buyarticle']['main']='
		<ol>
			<li>
				有效性:<br>这些交易条件的条款适用于由 '.$settings['store_name'].' 为您提供的产品销售服务。这些条款将有可能不时的被修正。
			</li>
			<li>
				'.$settings['store_name'].' 和您之间的契约
				<br />
				'.$settings['store_name'].' 网站上的价目表，声明并不构成要约。在 '.$settings['store_name'].' 向您发送电子邮件确认收到并接受了您的订单之前，您和 '.$settings['store_name'].' 之间不存在任何契约关系。'.$settings['store_name'].' 有权在发现了 '.$settings['store_name'].' 网站上显现的产品及订单的明显错误或缺货的情况下，单方面撤回任何契约。(参见下面第 3 条款)。'.$settings['store_name'].'保留对产品订购的数量的限制权。 在下订单的同时，您也同时承认了您已经达到购买这些产品的法定年龄，并将对您在订单中提供的所有信息的真实性负责。
			</li>
			<li>
				定价和可获性 
				<br />产品的定价和可获性都在 '.$settings['store_name'].' 的网站上指明。这类信息将随时更改且不发任何通知。每一项显示的价格都包含了增值税（按照中国的标准税率）。送货费将另外结算，费用根据您选择的送货方式的不同而异。如果发生了意外情况，在确认了您的订单后，由于供应商提价，税额变化引起的价格变化，或是由于网站的错误等造成当当的价格变化，'.$settings['store_name'].'会通过email或电话通知您，在 '.$settings['store_name'].' 没有取消订单的情况下，让您决定是否取消订单。 
			</li>
			<li>
				送货
				<br />'.$settings['store_name'].' 将会把产品送到您所指定的送货地址。送货时间由您选择的送货方式，产品的可获性，正常的处理过程来决定。我们会尽最大努力将商品快速地送达您的手中。
			</li>
			<li>
				适用的法律和管辖权
				<br />您和 '.$settings['store_name'].'之间的契约将适用中华人民共和国的法律，所有的争端将诉诸于 '.$settings['store_name'].' 所住地的人民法院。
			</li>
			<li>
				条款的无效性及其条件
				<br />如果出于任何原因，这些条款及其条件的部分不能得以实行，其他条款及其条件的有效性将不受影响。 
			</li>
		</ol>
	';
	
}elseif($type == 'platform_desc'){
	$defineinfo['platform_desc']['main']='
		<ul>
			<li>
				'.$settings['store_name'].'  购物平台由 <a href="http://www.dzsw.com" target="_blank">www.dzsw.com</a> 提供，dzsw　商城系统安全高效稳定，结合先进的　在线支付　平台，保证交易安全，全面支持在线电子商务。
			</li>
		</ul>
		<ul>
			<li>
				为保证购物安全，dzsw 推荐　在已经经过　dzsw　认证的商城购物，查看此商城的认证信息请点击：<a href="http://www.dzsw.com/renzheng.php?code='.$settings['renzheng_code'].'" target="_blank">查看认证</a>
			</li>
		</ul>
		<ul>
			<li>dzsw商城系统为开放源代码的商城系统，您可以免费获得，<br>请情请访问：<a href="http://www.dzsw.com" target="_blank">www.dzsw.com</a>。</li>
		</ul>				 
	';

}elseif($type == 'cantactus'){
	$defineinfo['cantactus']['main']='
		<ul>
			<li>
				电话联系
				<ul>
					<li>服务热线：'.$settings['server_tel'].' </li>
				</ul>
			</li>
			<li>
				E-mail联系
				<ul>
					<li>'.$settings['server_email'].'</li>
				</ul>
			</li>
			<li>
				信函联系
				<br />
				您的来信可寄到如下地址：
				<ul>
					<li>地 址：'.$settings['server_address'].'</li>
					<li>收信人：'.$settings['server_manname'].'</li>
					<li>邮 编：'.$settings['server_postcode'].' </li>
				</ul>
			</li>
		</ul>				 
	';
}

?>