<?php

namespace Tests\Unit\App\Database\Queries;

use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\_TestCase as TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Mockery;

abstract class _TestCase extends TestCase {

    public function assertHasOneOrManyQuery($name, $fClass, $fIdName, $fWheres = [])
    {
        $pClass     = $this->modelClass();
        $pIdName    = inst($pClass)->getKeyName();
        $pQuery     = $this->mMock($this->class())->makePartial();
        $pBaseQuery = $this->uniqueString();

        QueryMocker::qSelect($pQuery, $pIdName);
        QueryMocker::getQuery($pQuery, $pBaseQuery);

        InstanceMocker::add($fClass, $fModel = Mockery::mock());
        ModelMocker::aliasQuery($fModel, $fQuery = Mockery::mock());
        QueryMocker::qWhereIn($fQuery, $fIdName, $pBaseQuery);

        foreach ( $fWheres as $key => $value )
        {
            QueryMocker::qWhere($fQuery, $key, $value);
        }

        $this->assertEquals($pQuery->{$name . 'Query'}(), $fQuery);
    }

    public function assertBelongsToQuery($name, $fIdName, $pClass)
    {
        $pIdName    = (new $pClass)->getKeyName();
        $fQuery     = $this->mMock($this->class())->makePartial();
        $fBaseQuery = $this->uniqueString();

        QueryMocker::qSelect($fQuery, $fIdName);
        QueryMocker::getQuery($fQuery, $fBaseQuery);

        InstanceMocker::add($pClass, $pModel = Mockery::mock());
        ModelMocker::aliasQuery($pModel, $pQuery = Mockery::mock());
        QueryMocker::qWhereIn($pQuery, $pIdName, $fBaseQuery);

        $this->assertEquals($fQuery->{$name . 'Query'}(), $pQuery);
    }

    public function modelClass()
    {
        $className  = basename(static::class());
        $modelName  = preg_replace('/Query$/', '', $className);
        $modelClass = 'App\\Database\\Models\\' . $modelName;

        return $modelClass;
    }

    public static function testTestMethodExists()
    {
        static::verifyTestMethodExists('Query');
    }

}
