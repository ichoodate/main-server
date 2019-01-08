<?php

namespace Tests\Unit\App\Services;

use App\Database\Models\Card;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class PagingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'id' => ['integer'],

            'limit' => ['integer', 'max:100'],

            'order_by' => ['string', 'several_in_array:{{available_order_by}}'],

            'page' => ['integer']
        ]);
    }

    public function testCallbackQueryLimit()
    {
        $this->when(function ($proxy, $serv) {

            $limit = $this->uniqueString();
            $query = $this->mMock();

            $query->shouldReceive('take')->with($limit)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('limit', $limit);

            $this->verifyCallback($serv, 'query.limit');
        });
    }

    public function testCallbackQueryOrderByList()
    {
        $this->when(function ($proxy, $serv) {

            $orderByList = ['aaa' => 'asc', 'bbb' => 'desc'];
            $query       = $this->mMock();

            QueryMocker::qOrderBy($query, 'aaa', 'asc');
            QueryMocker::qOrderBy($query, 'bbb', 'desc');

            $proxy->data->put('order_by_list', $orderByList);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.order_by_list');
        });
    }

    public function testCallbackQueryCursor()
    {
        $this->when(function ($proxy, $serv) {

            $orderByList   = ['type1' => 'desc', 'type2' => 'asc'];
            $cursor        = $this->mMock();
            $query         = $this->mMock();

            $cursor->type1 = 'value1';
            $cursor->type2 = 'value2';

            ModelMocker::getKeyName($cursor, 'idx');
            ModelMocker::getKey($cursor, '1234');

            QueryMocker::qWhereOp($query, 'type1', '>=', 'value1');
            QueryMocker::qWhereOp($query, 'type2', '<=', 'value2');
            QueryMocker::qWhereOp($query, 'idx', '<', '1234');

            $proxy->data->put('order_by_list', $orderByList);
            $proxy->data->put('cursor', $cursor);
            $proxy->data->put('query', $query);

            $this->verifyCallback($serv, 'query.cursor');
        });

        $this->when(function ($proxy, $serv) {

            $orderByList   = ['type1' => 'asc', 'type2' => 'desc'];
            $cursor        = $this->mMock();
            $query         = $this->mMock();

            $cursor->type1 = 'value1';
            $cursor->type2 = 'value2';

            $proxy->data->put('order_by_list', $orderByList);
            $proxy->data->put('cursor', $cursor);
            $proxy->data->put('query', $query);

            ModelMocker::getKeyName($cursor, 'idx');
            ModelMocker::getKey($cursor, '1234');

            QueryMocker::qWhereOp($query, 'type1', '<=', 'value1');
            QueryMocker::qWhereOp($query, 'type2', '>=', 'value2');
            QueryMocker::qWhereOp($query, 'idx', '>', '1234');

            $this->verifyCallback($serv, 'query.cursor');
        });
    }

    public function testCallbackQuerySkip()
    {
        $this->when(function ($proxy, $serv) {

            $skip  = $this->uniqueString();
            $query = $this->mMock();

            $proxy->data->put('query', $query);
            $proxy->data->put('skip', $skip);

            $query->shouldReceive('skip')->with($skip)->once();

            $this->verifyCallback($serv, 'query.skip');
        });
    }

    public function testLoaderAvailableOrderByFields()
    {
        $this->when(function ($proxy, $serv) {

            $modelClass = Card::class;
            $return = [Card::CREATED_AT];

            $proxy->data->put('model_class', $modelClass);

            $this->verifyLoader($serv, 'available_order_by_fields', $return);
        });
    }

    public function testLoaderAvailableOrderBy()
    {
        $this->when(function ($proxy, $serv) {

            $availableOrderByFields = ['field3', 'field1', 'field2'];
            $return = ['field3 asc', 'field3 desc', 'field1 asc', 'field1 desc', 'field2 asc', 'field2 desc'];

            $proxy->data->put('available_order_by_fields', $availableOrderByFields);

            $this->verifyLoader($serv, 'available_order_by', $return);
        });
    }

    public function testLoaderCursor()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'cursor');
            });
        });
    }

    public function testLoaderLimit()
    {
        $this->when(function ($proxy, $serv) {

            $return = 12;

            $this->verifyLoader($serv, 'limit', $return);
        });
    }

    public function testLoaderPage()
    {
        $this->when(function ($proxy, $serv) {

            $return = 1;

            $this->verifyLoader($serv, 'page', $return);
        });
    }

    public function testLoaderOrderByList()
    {
        $this->when(function ($proxy, $serv) {

            $orderBy = 'aaa desc, bbb asc, ccc desc';
            $return  = ['aaa' => 'desc', 'bbb' => 'asc', 'ccc' => 'desc'];

            $proxy->data->put('order_by', $orderBy);

            $this->verifyLoader($serv, 'order_by_list', $return);
        });
    }

    public function testLoaderSkip()
    {
        $this->when(function ($proxy, $serv) {

            $page   = 3;
            $limit  = 15;
            $return = 30;

            $proxy->data->put('page', $page);
            $proxy->data->put('limit', $limit);

            $this->verifyLoader($serv, 'skip', $return);
        });
    }

}
