<?php
class ChildException extends Exception{
}
class ChildException2 extends Exception{
}
try{
	throw new ChildException("123");
} catch(ChildException2 $e){
	echo "ce2捕获处理\n";
} catch(ChildException $e){
	echo "ce捕获处理\n";
} catch(Exception $e){
	echo "基类Exception捕获处理\n";
}

class ChildException3 extends ChildException2{
}
try{
	throw new ChildException3("456");
} catch(ChildException $e){
	echo "ce捕获处理\n";
} catch(ChildException2 $e){
	echo "ce2捕获处理\n";
} catch(ChildException3 $e){
	echo "ce3捕获处理\n";
} catch(Exception $e){
	echo "基类Exception捕获处理\n";
}

//测试PHP中除数为0的问题
try{
	$a = 5/0;
} catch(Exception $e){
	var_dump(serialize($e));
}
