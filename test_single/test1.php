<?php
class A{
	private static $_instance=null;
	private function __construct(){
		
	}

	public static function getInstance(){
		if(!empty(self::$_instance)){
			echo "从单例中获取\n";
			return self::$_instance;
		} else{
			echo "实例化获取\n";
			self::$_instance = new A();
		}

		return self::$_instance;
	}
}

/*
1、直接在页面中循环调用10次，判断一次页面执行时，是否是单例
2、后续每次执行该脚本，判断当不同次请求时，是否是会重新实例化（脚本执行完成后，会回收资源）
3、后面设置将php-fpm子进程设置为1，每个子进程设置为1个子线程，看执行情况
*/
echo "----------执行开始----------\n";
for($i=0; $i<10; $i++){
	$ins = A::getInstance();
}
echo "--------执行完毕----------\n";die;
