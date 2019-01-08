<?php

namespace Tests\Unit;

class _Stub {

    protected $obj;

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    public function __call($method, $args)
    {
        $ref    = new \ReflectionClass($this->obj);
        $method = $ref->getMethod($method);

        $method->setAccessible(true);

        return $method->invokeArgs($this->obj, $args);
    }

    public function __get($property)
    {
        $ref  = new \ReflectionClass($this->obj);
        $prop = $ref->getProperty($property);
        $prop->setAccessible(true);

        return $prop->getValue($this->obj);
    }

    public function __set($property, $value)
    {
        $ref  = new \ReflectionClass($this->obj);
        $prop = $ref->getProperty($property);
        $prop->setAccessible(true);

        $prop->setValue($this->obj, $value);
    }

}
