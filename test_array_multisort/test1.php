<?php
$arr = [
	[
		"name" => "haha",
		"age" => 0
	],
	[
		"name" => "haha",
		"age" => -1
	]
];
$age = [0, -1];
array_multisort($age, SORT_NUMERIC, SORT_ASC, $arr);
var_dump($arr);
