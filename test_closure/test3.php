<?php
/*
测试use关键字引用的是外部自由变量的副本
*/
function f1() {
	$p1 = "p1";
	echo "匿名函数执行前：p1:$p1\n";
	$func = function() use ($p1) {
		$p1 = "p2";
		echo "匿名函数内修改后：p1:$p1\n";
	};
//	$func();
	echo "匿名函数执行完：p1:$p1\n";
}

f1();
