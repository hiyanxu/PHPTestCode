<?php
class A{
	private static $_cat = 'cat';
	private $_dog = 'dog';
	public $pig = 'pig';
}

$cat = static function() {
	var_dump(A::$_cat);
};

$dog = function() {
	var_dump($this->_dog);
};

$pig = function() {
	var_dump($this->pig);
};

$bindCat = Closure::bind($cat, null, 'A');
echo "bind cat\n";
$bindCat();
$bindDog = Closure::bind($dog, new A(), 'A');
echo "bind dog\n";
$bindDog();
$bindDog2 = Closure::bind($dog, null, 'A');
echo "bind dog2\n";
$bindDog2();

