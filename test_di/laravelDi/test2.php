<?php
/*
 * 工厂模式：将SuperMan对SuperPower的依赖，转移为SuperMan对工厂的依赖
 * */
class SuperPowerFactory {
    public function getSuperPower($superPower, $properties) {
        $superPowerObject = null;
        switch ($superPower) {
            case 'SuperPower1':
                $superPowerObject = new SuperPower1($properties[0], $properties[1]);
                break;
            case 'SuperPower2':
                $superPowerObject = new SuperPower2($properties[0], $properties[1]);
                break;
        }

        return $superPowerObject;
    }
}

/*
 * 通过对工厂的依赖，可以批量获取超能力
 * */
class SuperManV3{
    private $_superPower = null;
    public function __construct($superPowers)
    {
         $this->_superPower = new SuperPowerFactory($superPower[0], $superPower[1]);

//        foreach ($superPowers as $superPower) {
//            $this->_superPower[] = new SuperPowerFactory($superPower[0], $superPower[1]);
//        }
    }
}


/*
 * 工厂模式缺点：
 * 如果需要更多的superPower，则需要不断地增加case。（增加生产线）
 * */

/*
 * 增加接口契约：
 * 所有创建的SuperPower都需要遵循该接口
 * */
interface SuperPowerInterface {
    // 要求超能力都需要可以攻击
    public function attack();
}

class SuperPower3 implements SuperPowerInterface{
    public function attack() {
        echo "SuperPower3\n";
    }
}

/**
 * Class SuperManV4
 * Created on 2019-12-03 17:37
 * Created by hiyanxu
 * 让每个SuperMan只有一个专一的超能力
 */
class SuperManV4{
    private $_superPower = null;
    public function __construct(SuperPowerInterface $superPower)
    {
        $this->_superPower = $superPower;
    }
}

// 效率低下 每次要求有不同能力的超人时，需要每次都去new一个
$superMan = new SuperManV4(new SuperPower3());
$superMan = new SuperManV4(new SuperPower3());
$superMan = new SuperManV4(new SuperPower3());
$superMan = new SuperManV4(new SuperPower3());

/**
 * IOC容器的实现
 */
class Container
{
    protected $binds;

    protected $instances;

    /**
     * 绑定一种实例的生产方式
     */
    public function bind($abstract, $concrete)
    {
        // 该处暂定是闭包
        if ($concrete instanceof Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }

    /*
     * 真正的获取解析所需实例
     * */
    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        array_unshift($parameters, $this);

        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}

// 使用：先bind，再make
// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 先bind一个生产方法
$container->bind('superman', function($container, $superPower) {
    return new SuperManV4($container->make($superPower));
});
$container->bind('SuperPower3', function() {
    return new SuperPower3();
});

// make一个SuperMan
$superMan = $container->make('superman', 'SuperPower3');


















