<?php

namespace Tests;

use Faker\Generator as Faker;
use Mockery;

abstract class _TestCase extends TestCase {

    public static function assertException($executeClosure, $expectClosure = null)
    {
        try
        {
            call_user_func($executeClosure);
        }
        catch ( \Exception $e )
        {
            if ( $expectClosure != null )
            {
                call_user_func($expectClosure, $e);
            }

            static::success();

            return;
        }

        static::fail();
    }

    public static function factory($modelClass, ...$args)
    {
        $path = str_replace('App\\Database\\Models\\', '', $modelClass);

        return inst('Database\\Factories\\Models\\' . $path . 'Factory');
    }

    public static function invokeMethod($object, $method, $args, $public = true)
    {
        if ( is_string($method) )
        {
            $reflection = new \ReflectionClass($object);

            $method = $reflection->getMethod($method);

            if ( $public )
            {
                $method->setAccessible(true);
            }

            return $method->invokeArgs($object, $args);
        }
        else
        {
            $method = \Closure::bind($method, $object);

            return call_user_func_array($method, $args);
        }
    }

    public static function ref(...$args)
    {
        return new \ReflectionClass(...$args);
    }

    public function setUp() : void
    {
        parent::setUp();

        $this->faker = app(Faker::class);
    }

    public static function success()
    {
        static::assertTrue(true);
    }

    public static function uniqueString()
    {
        return str_random(50);
    }

}
