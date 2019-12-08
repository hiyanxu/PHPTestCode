<?php
/**
 * 简单di容器实现
 */
interface IDi {
    public function bind($abstract, $concrete);

    public function make($abstract, $parameters);

    public function get($abstract);

    public function has($abstract);
}

class Di implements IDi, ArrayAccess {
    // 解析出来的实例
    protected $instance = [];

    // 注册绑定的数据
    protected $bindAbstract = [];

    /**
     * 注册绑定  可覆盖方式
     * Created on 2019-12-08 10:53
     * Created by hiyanxu
     * @param $abstract 注册的实例名
     * @param $concrete 如何解析 闭包进行延迟加载
     */
    public function bind($abstract, $concrete) {
        $this->bindAbstract[$abstract] = $concrete instanceof Closure ? $concrete : function () use ($concrete) {
            return $concrete;
        };
        if (isset($this->instance[$abstract])) {
            unset($this->instance[$abstract]);
        }
    }

    /**
     * 解析获取实例
     * Created on 2019-12-08 10:54
     * Created by hiyanxu
     * @param $abstract 注册的实例名
     * @param null $parameters 解析实例需要的参数
     */
    public function make($abstract, $parameters = null) {
        if (isset($this->instance[$abstract])) {
            return $this->instance[$abstract];
        }

        if (!array_key_exists($abstract, $this->bindAbstract)) {
            throw new \Exception("Please bind $abstract");
        }

        // 支持闭包
        $buildAbstract = $this->bindAbstract[$abstract];
        if ($buildAbstract instanceof Closure) {
            $instance = $buildAbstract($this, $parameters);
            $this->instance[$abstract] = $instance;
            return $instance;
        }

        // 


    }

    /**
     * 获取实例
     * Created on 2019-12-08 11:00
     * Created by hiyanxu
     * @param $abstract
     */
    public function get($abstract) {

    }

    /**
     * 判断实例是否存在
     * Created on 2019-12-08 11:00
     * Created by hiyanxu
     * @param $abstract
     * @return bool
     */
    public function has($abstract) {
        return isset($this->instance[$abstract]) || isset($this->bindAbstract[$abstract]);
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->bind($offset, $value);
    }

    public function offsetUnset($offset)
    {
        unset($this->instance[$offset]);
        unset($this->bindAbstract[$offset]);
        return true;
    }
}