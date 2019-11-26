<?php
$func = function($param) {
	var_dump($param);
};

function dFunc($func, $param) {
	$func($param);
}
dFunc($func, '123');
