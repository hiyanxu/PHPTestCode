<?php
/**
 * 测试：
 * 测试反射出来的Params类型的判断
 */
class A {
    public function __construct()
    {
    }
}

class B {
    public $a = null;
    public $b = null;
    public function __construct(A $a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }
}

$reflector = new ReflectionClass("B");
$reflectorMethod = $reflector->getConstructor();
$refParams = $reflectorMethod->getParameters();
foreach ($refParams as $key => $value) {
    if (is_numeric($key)) {
        // parameters是一个数组，key是下标，value是对应的ReflectionParameter对象
        echo "numeric\n";
        var_dump($key, $value);
        var_dump($value->name);
    }
}

