<?php
$param = $_SERVER['argv'];
$materialId = $param[1];
$nonceKey = "9yV92Njqh9";

function getSign($materialId, $nonceKey) {
	$str = "materialId=$materialId&nonceKey=$nonceKey";
	$sign = strtoupper(md5($str));

	return $sign;
}


$url = "https://www.babyabc100.com/songs/cache/cancel.json";
//$url = "http://localhost:7768/songs/cache/cancel.json";
$sign = getSign($materialId, $nonceKey);
var_dump($sign);

var_dump(file_get_contents($url."?id=".$materialId."&sign=".$sign));
