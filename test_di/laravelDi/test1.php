<?php
/*
 * 测试：最初的依赖形式
 * 作为超人的超能力：需要传入具体的属性和属性值
 * */
class SuperMan{
    private $_property = null;
    private $_propertyValue = null;

    public function __construct($property, $propertyValue) {
        $this->_property = $property;
        $this->_propertyValue = $propertyValue;
    }
}

/*
 * 将超能力单独拿出来
 * 超能力1
 * */
class SuperPower1 {
    private $_property = null;
    private $_propertyValue = null;

    public function __construct($property, $propertyValue) {
        $this->_property = $property;
        $this->_propertyValue = $propertyValue;
    }
}

class SuperPower2 {
    private $_property = null;
    private $_propertyValue = null;

    public function __construct($property, $propertyValue) {
        $this->_property = $property;
        $this->_propertyValue = $propertyValue;
    }
}

class SuperManV2{
    private $_superPower = null;

    // 当需要多个的时候，仍然需要从外面传进来，，不可便面的形成了依赖：SuperMan对SuperPower的依赖
    public function __construct($superPower1) {
        $this->_superPower = $superPower1;

//        $this->_superPower = array(
//            $superPower1,
//            $superPower2
//        );
    }
}


