<?php

namespace Tests\Unit\App\Services\UserSelfKwdPvt;

use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\User;
use App\Services\ListingService;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class UserSelfKwdPvtListingServiceTest extends _TestCase {

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

            $authUser = $this->factory(User::class)->make();
            $query    = $this->mMock();

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('query', $query);

            QueryMocker::qWhere($query, UserSelfKwdPvt::USER_ID, $authUser->getKey());

            $this->verifyCallback($serv, 'query.auth_user');
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', UserSelfKwdPvt::class);
        });
    }

}
