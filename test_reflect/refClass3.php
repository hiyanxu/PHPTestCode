<?php
/**
 * 测试反射是否可以加载循环依赖
 * 例如：
 * 解析实例C，C依赖B，B又依赖A
 */
class A {
    public function __construct()
    {
        echo "A\n";
    }
}

class B {
    public $a = null;
    public function __construct(C $a)
    {
        $this->a = $a;
    }
}

class C {
    public $b = null;
    public $c = null;
    public function __construct(B $b, $c)
    {
        $this->b = $b;
        $this->c = $c;
    }
}

/**
 * 通过newInstanceArgs()解析
 * 可行：
 * 直接采用newInstanceArgs是可以解析循环依赖的（即例如：解析C，C依赖B，B又依赖A...）。
 * 但是要求将参数不断传入。
 */
//$a = new A();
//$reflector = new ReflectionClass("C");
//$instance = $reflector->newInstanceArgs([new B($a)]);
//var_dump($instance);


function make($abstract, $params=[]) {
    if ($abstract instanceof \Closure) {
        return $abstract($params);
    }

    $refParams = resolveParamContext($abstract, $params);
    return (new ReflectionClass($abstract))->newInstanceArgs($refParams);
}

function resolveParamContext($abstract, $params) {
    // 判断是否有构造函数
    $reflector = new ReflectionClass($abstract);

    $param = [];
    // 判断该类是否有构造函数，若有，解析构造函数所需的参数
    if ($reflector->hasMethod("__construct")) {
        $reflectorMethod = $reflector->getMethod('__construct');

        // 判断构造函数是否有参数
        $reflectorParams = $reflectorMethod->getParameters();
        if (count($reflectorParams) > 0) {
//            $params =



            foreach ($reflectorParams as $refParam) {
                if (isset($params[$refParam->getName()])) {
                    $param[] = $params[$refParam->getName()];
                    continue;
                }

                // 判断该参数类型，若是对象类型，则继续反解该类  暂时不支持对非对象类型的参数进行解析
                if ($paramClass = $refParam->getClass()) {
                    // 得到当前该对象的参数，实例化对象  最终对每一个$param的子数组来说，其实都是该参数的实例 例如B的实例
                    $args = resolveParamContext($paramClass->getName(), []);
                    $param[] = (new ReflectionClass($paramClass->getName()))->newInstanceArgs($args);
                }
            }
        }

    }

    return $param;
}

$instance = make("C", ['c'=>'cp']);
var_dump($instance);die;

















