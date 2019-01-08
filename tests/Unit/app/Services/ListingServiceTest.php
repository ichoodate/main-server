<?php

namespace Tests\Unit\App\Services;

use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class ListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'fields' => ['several_in:{{available_fields}}']
        ]);
    }

    public function testCallbackQueryFields()
    {
        $this->when(function ($proxy, $serv) {

            $query = $this->mMock();
            $fields = '1a ,2b , 3c,4d, 5e';

            QueryMocker::qSelect($query, ['1a', '2b', '3c', '4d', '5e']);

            $proxy->data->put('query', $query);
            $proxy->data->put('fields', $fields);

            $this->verifyCallback($serv, 'query.fields');
        });
    }

    public function testLoaderAvailableFields()
    {
        $this->when(function ($proxy, $serv) {

            $modelClass = \App\Database\Models\User::class;
            $return     = inst($modelClass)->getVisible();

            $proxy->data->put('model_class', $modelClass);

            $this->verifyLoader($serv, 'available_fields', $return);
        });
    }

    public function testLoaderFields()
    {
        $this->when(function ($proxy, $serv) {

            $availableFields = $this->uniqueString();
            $return          = $availableFields;

            $proxy->data->put('available_fields', $availableFields);

            $this->verifyLoader($serv, 'fields', $return);
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

    public function testLoaderQuery()
    {
        $this->when(function ($proxy, $serv) {

            $modelClass = \App\Database\Models\User::class;
            $user       = $this->mMock();
            $return     = $this->uniqueString();

            InstanceMocker::add($modelClass, $user);
            ModelMocker::aliasQuery($user, $return);

            $proxy->data->put('model_class', $modelClass);

            $this->verifyLoader($serv, 'query', $return);
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $query  = $this->mMock();
            $return = $this->uniqueString();

            QueryMocker::get($query, $return);

            $proxy->data->put('query', $query);

            $this->verifyLoader($serv, 'result', $return);
        });
    }

}
