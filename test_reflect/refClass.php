<?php
class A {
	private $_p1 = "p1";
	private static $_ps1 = "ps1";
	public $p2 = "p2";

	public function __construct($p1, $p2) {
		var_dump($p1, $p2);
	}

	public function func1($a) {
		var_dump($a);
	} 
}

/*
1、通过Reflection打印
2、通过ReflectionClass打印
*/
$refClass = new ReflectionClass('A');
Reflection::export($refClass);

ReflectionClass::export('A');
