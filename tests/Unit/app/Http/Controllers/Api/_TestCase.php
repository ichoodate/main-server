<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use Closure;
use Tests\Unit\_TestCase as TestCase;
use App\Database\Model;

class _TestCase extends TestCase {

    public function assertReturn($expect)
    {
        $class   = static::class();
        $func    = $this->getTestName();
        $action  = $this->getAction($func);
        $actual  = $class::$action();

        $this->assertEquals($expect, $actual);
    }

    public function getTestName()
    {
        $traces = debug_backtrace();

        foreach ( $traces as $trace )
        {
            if ( array_key_exists('class', $trace) && is_a($trace['class'], static::class, true) && starts_with($trace['function'], 'test') )
            {
                return $trace['function'];
            }
        }

        throw new \Exception('test function not exists.');
    }

    public function getAction($testFuncName)
    {
        if ( starts_with($testFuncName, 'testDestroy') )
        {
            $action = 'delete';
        }
        else if ( starts_with($testFuncName, 'testIndex') )
        {
            $action = 'index';
        }
        else if ( starts_with($testFuncName, 'testStore') )
        {
            $action = 'store';
        }
        else if ( starts_with($testFuncName, 'testUpdate') )
        {
            $action = 'update';
        }
        else if ( starts_with($testFuncName, 'testShow') )
        {
            $action = 'show';
        }
        else
        {
            throw new \Exception;
        }

        return $action;
    }

    public function setAuthUser($user)
    {
        auth()->setUser($user);
    }

    public function setInputParameter($key, $value)
    {
        request()->offsetSet($key, $value);
    }

    public function setRouteParameter($key, $value)
    {
        $route  = call_user_func(request()->getRouteResolver());
        $params = is_null($route) ? [] : get_object_vars($route);

        $params[$key] = $value;

        request()->setRouteResolver(function () use ($params) {

            $inst = new \stdClass;

            foreach ( $params as $key => $value )
            {
                $inst->{$key} = $value;
            }

            return $inst;
        });
    }

    public function when()
    {
        $args = func_get_args();

        app('db')->beginTransaction();

        call_user_func($args[0]);

        app('db')->rollback();
    }

    public function testTestMethodImplement()
    {
        $class   = $this->class();
        $parent  = get_parent_class($class);
        $methods = array_diff(get_class_methods($class), get_class_methods($parent));

        foreach ( $methods as $method )
        {
            $this->assertContains('test' . ucfirst($method), get_class_methods(static::class));
        }
    }

}
