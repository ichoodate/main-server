<?php

namespace Tests\Unit\App\Services\Balance;

use App\Database\Models\Balance;
use App\Database\Models\User;
use App\Services\ListingService;
use App\Services\Balance\BalanceFindingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class BalanceListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            ListingService::class
        ]);
    }

    public function testCallbackQueryAuthUser()
    {
        $this->when(function ($proxy, $serv) {

            $query       = $this->mMock();
            $authUser    = $this->factory(User::class)->make();

            QueryMocker::qWhere($query, Balance::USER_ID, $authUser->getKey());

            $proxy->data->put('query', $query);
            $proxy->data->put('auth_user', $authUser);

            $this->verifyCallback($serv, 'query.auth_user');
        });
    }

    public function testLoaderCursor()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->uniqueString();
            $id       = $this->uniqueString();
            $return   = [BalanceFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $id
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('id', $id);

            $this->verifyLoader($serv, 'cursor', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Balance::class);
        });
    }

}
