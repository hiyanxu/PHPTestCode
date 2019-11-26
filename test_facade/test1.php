<?php
/*
几个下层子系统
*/
class Light1{
	public function open(){
		echo 'light1->open'."\n";
	}
}

class Light2{
	public function open(){
		echo "light2->open\n";
	}
}

class TV{
	public function open(){
		echo "TV->open\n";
	}
}

/*
facade类 中间隔离
*/
class Facade{
	private $light1;
	private $light2;
	private $TV;

	public function __construct(){
		$this->light1 = new Light1();
		$this->light2 = new Light2();
		$this->TV = new TV();
	}

	public function open(){
		$this->light1->open();
		$this->light2->open();
		$this->TV->open();
	}
}

/*
客户端调用  仅调用facade类，和下层隔离
*/
$facade = new Facade();
$facade->open();

