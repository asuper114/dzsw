<?php

/*----------------------------------------------------
	[dzsw] languages/faq_shipping.php


----------------------------------------------------*/

if(in_array('goodsself',$faq_shipping_body)){ 
	$faq_message['shipping'][]='
		<ul>
			<li>目前我们开通了以下城市的送货上门服务：'.$googsself_city.'</li>
		</ul>	
	';

}

if(in_array('commonpost',$faq_shipping_body)){
	$faq_message['shipping'][]='
		<ul>
			<li>送货费用 =  运费 ＋ 挂号费(3元)
				<ul>
					<li>运费： 按邮政规定费率计算，全国不同省市运费不同。运费按照商品重量计算得出 </li>
					<li>挂号费： 按邮政规定为3元/票 </li>
                </ul>
			</li>
			<li>在途时间：按邮政系统服务时限3～15个工作日 </li>
		</ul>	
	';
}


if(in_array('quick',$faq_shipping_body)){
	$faq_message['shipping'][]='
        <ul>
			<li>送货费用 = 运费 ＋ 挂号费
                <ul>
					<li>运费： 按邮政规定费率计算，全国不同省市运费不同。此配送方式的费用低于普通配送高于邮政EMS。</li>
					<li>挂号费： 按邮政规定为3元/票 </li>
                </ul>
			</li>
			<li>在途时间：按邮政系统服务时限3～7个工作日 </li>
		</ul>    
	';

}

if(in_array('chinapostems',$faq_shipping_body)){
	$faq_message['shipping'][]='
		<ul>
			<li>查询电话：各地11185</li>
			<li>送货费用 = 运费 ＋ 挂号费
				<ul>
					<li>运费： 按邮政规定费率计算，全国不同省市运费不同。此送货方式最安全，速度最快，但价格最高。</li>
					<li>挂号费： 按送货目的地会有所不同 </li>
				</ul>
			</li>
			<li>按邮政系统服务时限1～3天（节假日不休息） </li>
		</ul>
	';
}


?>

