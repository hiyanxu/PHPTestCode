<?php
$a = [
	[
		"id" => 1
	]
];
array_walk($a, function(&$value, $key, $name){
	$value['name'] = $name;
}, 'haha');
var_dump($a);
