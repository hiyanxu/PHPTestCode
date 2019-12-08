<?php
/*
 * 测试：
 * 测试反射是否可以解析有依赖存在的情况
 *
 * B实例化时，需要依赖A
 * */
class A {
    public function __construct()
    {
        echo "A\n";
    }
}

class B {
    public $a = null;

    /**
     * B constructor.
     * @param A $a
     * A通过委托将$a对象给到a属性  形成了B对于A的依赖
     */
    public function __construct(A $a)
    {
        $this->a = $a;
    }
}

$reflector = new ReflectionClass("B");

/**
 * 方式1：$instance = $reflector->newInstance();
 * 该种方式会报错：
 *  Catchable fatal error: Argument 1 passed to B::__construct() must be an instance of A, none given
 * 原因：
 *  在实例化B时，需要在构造函数中给出参数A的实例。
 */
//$instance = $reflector->newInstance();

/**
 * 方式二：
 * 该种方式可以通过，因为在实例化B时，给出了参数"A类的对象实例"
 */
$instance = $reflector->newInstanceArgs([new A()]);
var_dump($instance);

