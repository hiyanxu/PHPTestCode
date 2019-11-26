<?php
/*
测试继承类修改基类的方法默认值，报错级别
*/
class A{
	public function haha($a=null) {
		if(!is_null($a)) {
			var_dump($a);
		}
	}
}

class B extends A {
	public function haha($a){
		var_dump($a);
	}
}

(new B())->haha('b');
