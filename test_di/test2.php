<?php
class A{
	public function a() {
		echo "a\n";
	}
}

$a = create_instance("A");
$a->a();
