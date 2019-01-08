<?php

namespace Tests\Unit\App\Database\Models;

use Tests\_InstanceMocker as InstanceMocker;

class _Mocker {

    public static function aliasQuery($mock, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive('aliasQuery')->withNoArgs()->once()->andReturn($return);
    }

    public static function create($mock, $attrs, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive('create')->with($attrs)->once()->andReturn($return);
    }

    public static function find($mock, $id, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive('find')->with($id)->once()->andReturn($return);
    }

    public static function findMany($mock, $ids, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive('findMany')->with($ids)->once()->andReturn($return);
    }

    public static function getKey($mock, $return)
    {
        $mock->shouldReceive('getKey')->withNoArgs()->once()->andReturn($return);
    }

    public static function getKeyName($mock, $return)
    {
        $mock->shouldReceive('getKeyName')->withNoArgs()->once()->andReturn($return);
    }

    public static function newQuery($mock, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive('newQuery')->withNoArgs()->once()->andReturn($return);
    }

    public static function newCollection($mock, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive('newCollection')->withNoArgs()->once()->andReturn($return);
    }

    public static function relatedQuery($mock, $name, $return)
    {
        if ( is_string($class = $mock) )
        {
            InstanceMocker::add($class, $mock = _TestCase::mMock());
        }

        $mock->shouldReceive($name . 'Query')->withNoArgs()->once()->ordered()->andReturn($return);
    }

}
