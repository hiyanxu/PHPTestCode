<?php
/**
 * 多重依赖解析
 */
function make($abstract, $parameters=[]) {
    if ($abstract instanceof \Closure) {
        return $abstract($parameters);
    }

    $resolveParams = resolveParamContext($abstract, $parameters);
    return (new ReflectionClass($abstract))->newInstanceArgs($resolveParams);
}

function resolveParamContext($abstract, $parameters = []) {
    $reflector = new ReflectionClass($abstract);

    $resolveParams = [];
    if ($reflectorMethod = $reflector->getMethod("__construct")) {
        $reflectorParameters = $reflectorMethod->getParameters();
        foreach ($reflectorParameters as $parameter) {
            if (array_key_exists($parameter->getName(), $parameters)) {
                if (!empty($parameters[$parameter->getName()])) {
                    $resolveParams[] = $parameters[$parameter->getName()];
                    continue;
                } else if ($parameter->isDefaultValueAvailable()){
                    $resolveParams[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("parameter ".$parameter->getName()." none given");
                }
            }

            // 对象类型多重依赖解析
            if ($class = $parameter->getClass()) {
                $className = $class->getName();
                $resolveParams[] = (new ReflectionClass($className))
                    ->newInstanceArgs(resolveParamContext($className, $parameters));
            }
        }
    }

    return $resolveParams;
}

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
    public function __construct(A $a)
    {
        $this->a = $a;
    }
}

class C {
    public $b = null;
    public $c = null;
    public $default = null;
    public function __construct(B $b, $c, $default='default')
    {
        $this->b = $b;
        $this->c = $c;
        $this->default = $default;
    }
}

var_dump(make('C', ['c' => 'c_param']));