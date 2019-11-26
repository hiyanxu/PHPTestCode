<?php
use Phalcon\Di;

class A extends Di{
	public function bootstrap(){
		$this->bootstrapBaseService(new B());
		echo "start\n";
		$this->getB();
	}

	public function bootstrapBaseService($instance) {
	    $this['B'] = function () use ($instance) {
            echo "1234\n";
            return $instance;
        };
    }

    public function getB() {
	    echo "getB\n";
	    $this["B"]->haha();
    }
}

class B{
    public function haha() {
        echo "getB haha\n";
    }
}

(new A())->bootstrap();