<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Tests\Unit\_TestCase as TestCase;

class _TestCase extends TestCase {

    public function assertReturn($expect)
    {
        $traces = debug_backtrace();

        foreach ( $traces as $trace )
        {
            if ( array_key_exists('class', $trace) && is_a($trace['class'], static::class, true) && starts_with($trace['function'], 'test') )
            {
                $class  = static::class();
                $action = $trace['function'];
                $action = str_replace('test', '', $action);
                $action = lcfirst($action);
                $actual = $class::$action();

                if ( is_array($expect) )
                {
                    ksort($expect);
                    ksort($actual);
                }

                $this->assertEquals($expect, $actual);
            }
        }
    }

    public function setAuthUser()
    {
        $user = $this->factory(User::class)->create();

        auth()->setUser($user);

        return $user;
    }

    public function setInputParameter($key)
    {
        $value = $this->uniqueString();

        Request::offsetSet($key, $value);

        return $value;
    }

    public function setRouteParameter($key, $value=null)
    {
        if ( empty($value) )
        {
            $value = $this->uniqueString();
        }

        $route = \Mockery::mock('\Illuminate\Routing\Route')->makePartial();
        $route->bind(request());
        request()->setRouteResolver(function () use ($route)
        {
            return $route;
        });
        request()->route()->setParameter($key, $value);

        return $value;
    }

    public function testMethodExist()
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
