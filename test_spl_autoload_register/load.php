<?php
function my_autoload1($classes){
	if(file_exists("classes/".$classes.".php")){
		require_once("classes/".$classes.".php");
	} else {
		die("1、文件不存在");
	}
}

function my_autoload2($classes){
	if(file_exists("classes2".$classes.".php")){
		require_once("classes2/".$classes.".php");
	} else {
		die("2、文件不存在");
	}
}

//注册自动加载
spl_autoload_register("my_autoload1");
spl_autoload_register("my_autoload2");

Test1::test();
Test2::test();
