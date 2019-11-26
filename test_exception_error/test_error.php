<?php
//E_PARSE
//z=1;

/*
//E_RECOVERABLE_ERROR
class A{
}
class B{
}

function testCall(A $a){

}

testCall(new B());
*/
/*
ini_set("html_errors", 1);
ini_set("docref_root", "https://secure.php.net/manual/zh/");

include('hah.php');
*/

//测试E_ERROR
//haha();  //调用一个不存在的方法时，会导致E_ERROR级别的错误，输出Fatal Error

//throw new Exception("123");  //当发生未捕获的异常时，也会导致E_ERROR级别的错误，输出Fatal Error
/*
//测试E_STRICT
function change(&$var){
	$var += 10;
}

$var =1;
change(++$var);
*/

//测试E_RECOVERABLE_ERROR
class A{}
class B{}

function testCall(A $a){}
testCall(new B());
