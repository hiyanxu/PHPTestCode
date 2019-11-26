<?php
$arr = [
	[
		"id"=>1,
		"score"=>1
	],
	[
		"id"=>2,
		"score"=>2
	],
	[
		"id"=>1,
		"score"=>3,
	],
	[
		"id"=>2,
		"score"=>4
	]
];
var_dump(array_column($arr, null, "id"));
