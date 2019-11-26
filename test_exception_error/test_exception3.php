<?php
//测试用set_exception_handler函数处理后，程序是否会继续往下执行
function exception_handler($e){
	echo 'here'."\n";
	var_dump(serialize($e));
}

set_exception_handler("exception_handler");

throw new Exception("123");
echo "\n异常处理完成，继续执行\n";
