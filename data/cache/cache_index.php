<?php
//dzsw cache file
//Filename ./data/cache/cache_index.php
//Created on 2016-04-13

$INDEX_NEW_CACHE = array
	(
	0 => array
		(
		'products_id' => '21',
		'price' => '24.00',
		'name' => 'Ĭ',
		's_p' => '0',
		'image' => '0',
		'IF(p.s_p>0 , sp.s_price, NULL)' => '',
		'imagesrc' => 'images/default/nopicture.gif'
		),
	1 => array
		(
		'products_id' => '8',
		'price' => '24.00',
		'name' => '测试1',
		's_p' => '1',
		'image' => '28',
		'IF(p.s_p>0 , sp.s_price, NULL)' => '1.00',
		'imagesrc' => 'images/default/nopicture.gif'
		)
	);

$INDEX_S_CACHE = array
	(
	0 => array
		(
		'products_id' => '8',
		'price' => '24.00',
		'name' => '测试1',
		's_p' => '1',
		'image' => '28',
		's_price' => '1.00',
		'imagesrc' => 'images/default/nopicture.gif'
		)
	);

?>