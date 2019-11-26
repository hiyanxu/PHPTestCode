<?php
namespace BaiJia\App;

require 'vendor/autoload.php';

use BaiJia\App\Controllers\Test1Controller;

class Haha{
	public function haha(){			
		$obj = new Test1Controller();
		$obj->func1();
	}	
}

$haha = new Haha();
$haha->haha();
