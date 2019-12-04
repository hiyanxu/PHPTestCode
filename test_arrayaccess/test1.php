<?php
/*
测试ArrayAccess接口的var_dump调用
*/
class A implements ArrayAccess {
	public static $_services = array();

	public function offsetSet($key, $value) {
		self::$_services[$key] = $value;
		return true;
	}

	public function offsetGet($key) {
		echo "run offsetGet $key\n";
		if($this->offsetExists($key)) {
			return self::$_services[$key];
		}	
		return false;
	}

	public function offsetExists($key) {
		return array_key_exists($key, array_keys(self::$_services));
	}

	public function offsetUnset($key) {
		unset(self::$_services[$key]);
		return true;
	}
}

class B extends A {
	public function set() {
		for($i = 0; $i < 10; $i++) {
			self::$_services[$i] = function () use ($i) {
				echo "run closure $i\n";
				return $i;
			};
		}
		echo "set complete\n";
		return true;
	}

	public function get() {
		echo "开始测试var_dump()时，是否会执行offsetGet\n";
		var_dump(self::$_services);
		echo "var_dump()完成\n";
	}
}

$b = new B();
$b->set();
$b->get();
