<?php

namespace Tests\Unit\App\Services;

use App\Database\Models\User;
use Tests\Unit\App\Services\_TestCase;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;

class FindingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'id' => ['required', 'integer'],

            'model' => ['not_null']
        ]);
    }

    public function testLoaderModel()
    {
        $this->when(function ($proxy, $serv) {

            $model      = $this->mMock();
            $modelClass = \App\Database\Models\Card::class;
            $id         = $this->uniqueString();
            $return     = $this->uniqueString();

            InstanceMocker::add($modelClass, $model);
            ModelMocker::find($model, $id, $return);

            $proxy->data->put('id', $id);
            $proxy->data->put('model_class', $modelClass);

            $this->verifyLoader($serv, 'model', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'model_class');
            });
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $model  = $this->mMock();
            $return = $model;

            $proxy->data->put('model', $model);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
