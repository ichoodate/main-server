<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\_Stub;
use Tests\_TestCase as TestCase;

class _TestCase extends TestCase {

    use DatabaseMigrations;

    public static function class()
    {
        $parts = explode('\\', static::class);

        array_shift($parts);
        array_shift($parts);

        $parts[count($parts) - 1] = preg_replace('/Test$/', '', end($parts));

        return implode('\\', $parts);
    }

    public static function mMock(...$args)
    {
        return Mockery::mock(...$args);
    }

    public function proxy($instance)
    {
        return inst(_Stub::class, [$instance]);
    }

    protected function refreshApplication()
    {
        putenv('APP_ENV=unit-testing');

        $this->app = $this->createApplication();
    }

    public function setUp()
    {
        parent::setUp();

        $this->class = $this->class();

        app('db')->statement('PRAGMA foreign_keys = OFF;');
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $segments = explode('\\', static::class());

        if ( ! starts_with(array_pop($segments), '_') )
        {
            static::assertTrue(class_exists(static::class()), static::class() . ' class does not exists');
        }
    }

    public function tearDown()
    {
        // app('db')->statement('PRAGMA foreign_keys = ON;');

        InstanceMocker::empty();

        Mockery::close();

        parent::tearDown();
    }

    public function when()
    {
        $serv  = inst($this->class());
        $proxy = $this->proxy($serv);
        $args  = func_get_args();
        $func  = array_shift($args);

        call_user_func_array($func, array_merge([$proxy, $serv], $args));
    }

}
