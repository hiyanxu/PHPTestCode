<?php
function a() {
	try {
		b();
	} catch (\Exception $e) {
		var_dump($e->getMessage());
	}

	return 1;
}

function b() {
	throw new Exception("exception!");
}

$a = a();
var_dump($a);
