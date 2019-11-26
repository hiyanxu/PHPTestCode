<?php
try{
	throw new Exception('hahaha');
} catch(Exception $e){
	echo '异常了！'."\n";
	var_dump($e);
}

echo '123'."\n";


//测试不同层级异常处理
echo "测试不同层级异常处理：\n";
class ChildException extends Exception{
}

try{
	throw new ChildException("---child---用ChildException异常类接收");
} catch(ChildException $e){
	var_dump($e);
}

//测试exception能够接到异常
try{
	throw new ChildException("---child2---用基类Exception类接收");
} catch(Exception $e){
	var_dump($e);
}


echo "\n测试多catch类异常处理逻辑\n";
try{
	throw new ChildException("---child---多级exception catch处理");
}catch(ChildException $e){
	echo "用ChildException接收处理了\n";
	var_dump(serialize($e));
}catch(Exception $e){
	echo "用Exception接收处理了\n";
	var_dump(serialize($e));
}

echo "\n测试多catch异常类处理  将基类exception放在最上面\n";
try{
	throw new ChildException("---child---3");
} catch(Exception $e){
	echo "用Exception接收处理了\n";
	var_dump(serialize($e));
} catch(ChildException $e){
	echo "用ChildException接收处理了\n";
	var_dump(serialize($e));
}

echo "测试throw不同异常时的捕获场景\n";
class ChildException2 extends Exception{
}
try{
	throw new ChildException2("其它类型异常");
} catch(ChildException $e){
	echo "用ce接收处理\n";
} catch(ChildException2 $e){
	echo "用ce2接收处理\n";
}

echo "测试没有找到异常处理类时，用基类兜底处理\n";
class ChildException3 extends ChildException2{}
try{
	throw new ChildException3("ce3异常");
} catch(ChildException $e){
	echo "ce接收\n";
} catch(ChildException2 $e){
	echo "用ce2接收\n";
} catch(Exception $e){
	echo "用基类处理\n";
	var_dump(serialize($e));
}

