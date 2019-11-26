<?php
$a = [
	[
		'id' => 1,
		'name' => '姓名1'
	],
	[
		'id' => 2,
		'name' => '姓名2'
	],
	[
		'id' => 3,
		'name' => '姓名3'
	]
];
$b = array_column($a, null, 'name');
var_dump($b);

$c = array_column($a, 'id', 'name');
var_dump($c);
