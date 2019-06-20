<?php

namespace Tests\Unit\App\Database\Models;

use Tests\Unit\App\Database\_TestCase as TestCase;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Mockery;

abstract class _TestCase extends TestCase {

    public function assertHasOneOrManyQuery($name, $fClass, $fIdName, $attrs = [], $conditions = [])
    {
        $pModel = $this->factory(static::class())->make($attrs);

        InstanceMocker::add($fClass, $fModel = Mockery::mock());
        ModelMocker::query($fModel, $fQuery = Mockery::mock());
        QueryMocker::qWhere($fQuery, $fIdName, $pModel->getKey());

        foreach ( $conditions as $key => $value )
        {
            QueryMocker::qWhere($fQuery, $key, $value);
        }

        $this->assertEquals($pModel->{$name . 'Query'}(), $fQuery);
    }

    public function assertBelongsToQuery($name, $fIdName, $pClass, $attrs = [])
    {
        $pIdName = (new $pClass)->getKeyName();
        $fModel  = $this->factory(static::class())->make($attrs);

        InstanceMocker::add($pClass, $pModel = Mockery::mock());
        ModelMocker::query($pModel, $pQuery = Mockery::mock());
        QueryMocker::qWhere($pQuery, $pIdName, $fModel->{$fIdName});

        $this->assertEquals($fModel->{$name . 'Query'}(), $pQuery);
    }

    public function testNewCollection()
    {
        inst($this->class())->newCollection();

        $this->success();
    }

    public static function testTestMethodExists()
    {
        static::verifyTestMethodExists('Query');
    }

}
