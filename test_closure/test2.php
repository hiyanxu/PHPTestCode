<?php
function cFunc($param) {
	$func = function($param1) use ($param) {
		echo "param1:".$param1."\n";
		echo "param2:".$param."\n";
	};
	return $func;
}

$rCFunc = cFunc("123");
$rCFunc("456");
