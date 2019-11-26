<?php
class A {
	public function haha($str="str") {
		echo "a\n";
		echo $str."\n";
		//$b->b();
	}
}

class B {
	public function hahab() {
		echo "b\n";
	}
}
//(new A())->haha();die;

$ref = new ReflectionMethod("A", 'haha');
var_dump($ref->class);
