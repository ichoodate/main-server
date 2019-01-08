<?php

namespace Tests\Unit\App\Database\Collections;

class _Mocker {

    public static function all($mock)
    {
        $return = count(func_get_args()) > 1 ? func_get_args()[1] : $mock;

        $mock->shouldReceive('all')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function count($mock)
    {
        $return = count(func_get_args()) > 1 ? func_get_args()[1] : $mock;

        $mock->shouldReceive('count')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function merge($mock, $item)
    {
        $return = count(func_get_args()) > 2 ? func_get_args()[2] : $mock;

        $mock->shouldReceive('merge')->with($item)->once()->ordered()->andReturn($return);
    }

    public static function modelKeys($mock)
    {
        $return = count(func_get_args()) > 1 ? func_get_args()[1] : $mock;

        $mock->shouldReceive('modelKeys')->withNoArgs()->once()->ordered()->andReturn($return);
    }

    public static function pluck($mock, $item)
    {
        $return = count(func_get_args()) > 2 ? func_get_args()[2] : $mock;

        $mock->shouldReceive('pluck')->with($item)->once()->ordered()->andReturn($return);
    }

    public static function push($mock, $item)
    {
        $return = count(func_get_args()) > 2 ? func_get_args()[2] : $mock;

        $mock->shouldReceive('push')->with($item)->once()->ordered()->andReturn($return);
    }

}
