<?php

namespace Tests;

class _InstanceMocker {

    public static $mocked = [];

    public static function add($class, $mock, $constArgs = [], $count = 1)
    {
        if ( ! array_key_exists($class, static::$mocked) )
        {
            app()->bind($class, function ($app, $bindArgs) use ($class) {

                $index    = false;
                $mockings = array_get(static::$mocked, $class, []);

                foreach ( $mockings as $i => $mocking )
                {
                    $constArgs = $mocking[1];

                    if ( $constArgs == $bindArgs )
                    {
                        $index = $i;

                        break;
                    }
                }

                if ( $index !== false )
                {
                    $matchInst = static::$mocked[$class][$index][0];
                    $count     = static::$mocked[$class][$index][2];

                    if ( $count !== null )
                    {
                        $count = $count - 1;

                        static::$mocked[$class][$index][2] = $count;
                    }

                    if ( $count === 0 )
                    {
                        unset(static::$mocked[$class][$index]);
                    }

                    return $matchInst;
                }
                else
                {
                    return new $class(...$bindArgs);
                }
            });

            static::$mocked[$class] = [];
        }

        if ( $count === null )
        {
            array_unshift(static::$mocked[$class], [$mock, $constArgs, $count]);
        }
        else
        {
            array_push(static::$mocked[$class], [$mock, $constArgs, $count]);
        }
    }

    public static function empty()
    {
        static::$mocked = [];
    }

}
