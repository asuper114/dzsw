<?php
/*----------------------------------------------------
	[dzsw] languages/faq_member.php

----------------------------------------------------*/


$faq_message['member'][]='
	<ol>
		<li>  		
			本网站在多次调查和论证的基础上，结合国内商业运作的实际情况和交易习惯，实行“会员积分制”，以此建立网站与会员之间的信用体系。 
		</li>
		<li>
			实行“会员积分制”首先是建立资料更加完善的会员帐户。帐户资料除了会员联系信息等基本资料外，还有会员的所有订单查询与管理、积分明细等。这样一来，网站和会员双方都可以方便地查询会员资料或交易资料，并在各自的权限内作相应的操作。如会员可修改个人资料、查询订单、取消订单等；而  '.$settings['store_name'].' 管理员则可以进行订单确认、订单完成等管理。 
		</li>
		<li>
			在不断的交易与交流过程中，会员随着积分的增多，享受的购物优惠也更多。 
		</li>
		<li>
			我们希望在长期的合作中，建立起与会员之间的信用体系，在相互信任的基础上进行更方便、更快捷、更优惠的购买服务，并且使这种服务可以长久地持续下去。
		</li>
		</li> 
	</ol>
';

$faq_message['member'][]='
	<ol>
		<li> 
			会员积分达到一定程度，会自动升级到相应的会员等级，进而享受相应的购物优惠，各星级的积分及相应的优惠见下表。</li>
		<li> 
			'.$member_higher['title'].' 向商城管理员提交申请，经审核批准后，即可成为 '.$specials_title.' 
		</li>
	</ol>
	<strong>会员星级积分与优惠表： </strong> <br><br>  
		<table width="80%" border="1" cellspacing="0" cellpadding="2" bordercolorlight="#000000" bordercolordark="#FFFFFF" align="center">
		<tr bgcolor="#EEEEEE">
			<td width="16%">
                <div align="center">会员等级</div>
			</td>
			<td width="27%">
                <div align="center">积分</div>
			</td>
			<td width="10%">
                <div align="center">折扣</div>
			</td>
		</tr>'.$usergroup_faq.'
		</table>
		<br>				 
';
          
$faq_message['member'][]='
	<ol>
		<li>
			每次订单购买完成，根据金额多少加分，加分计算方法为每 '.$settings['nt_tomark'].' 元加 1 分。例如，某订单总额共为 128 元，则加分'.round(128/$settings['nt_tomark']).' 分。 四佘五入，不足一分，不纳入计算范围。
		</li>
		<li>
			更多的加分措施将不断推出…… 
		</li>
	</ol>
';
?>

