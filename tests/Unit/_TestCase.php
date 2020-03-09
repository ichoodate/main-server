<?php

namespace Tests\Unit;

use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\_Stub;
use Tests\_TestCase as TestCase;

class _TestCase extends TestCase {

    use DatabaseMigrations;

    public $environment = 'unit';

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

    public function setUp() : void
    {
        parent::setUp();

        $this->class = $this->class();
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

    public function when()
    {
        $inst  = inst($this->class());
        $proxy = $this->proxy($inst);
        $args  = func_get_args();
        $func  = array_shift($args);

        app('db')->beginTransaction();

        call_user_func_array($func, array_merge([$proxy, $inst], $args));

        app('db')->rollback();
    }

    public function tearDown() : void
    {
        InstanceMocker::empty();
        Mockery::close();

        inst(Faker::class)->unique($reset = true);

        parent::tearDown();
    }

}
