<?php

namespace Tests\Unit\App\Services\UserSelfKwdPvt;

use App\Database\Models\Obj;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\User;
use App\Database\Models\Keyword\Smoke;
use App\Services\Keyword\Smoke\SmokeFindingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class SmokeUserSelfKwdPvtCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'keyword_id'
                => ['required']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testCallbackAuthUser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $smoke           = $this->mMock();
            $smokeQuery      = $this->mMock();
            $smokeBaseQuery  = $this->mMock();
            $kwdPvt          = $this->mMock();
            $kwdPvtQuery     = $this->mMock();
            $kwdPvtBaseQuery = $this->mMock();

            InstanceMocker::add(Smoke::class, $smoke);
            ModelMocker::query($smoke, $smokeQuery);
            QueryMocker::qSelect($smokeQuery, Smoke::ID);
            QueryMocker::getQuery($smokeQuery, $smokeBaseQuery);

            InstanceMocker::add(UserSelfKwdPvt::class, $kwdPvt);
            ModelMocker::query($kwdPvt, $kwdPvtQuery);
            QueryMocker::qWhere($kwdPvtQuery, UserSelfKwdPvt::USER_ID, $authUser->getKey());
            QueryMocker::qWhereIn($kwdPvtQuery, UserSelfKwdPvt::KEYWORD_ID, $smokeBaseQuery);
            QueryMocker::delete($kwdPvtQuery);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyCallback($serv, 'auth_user');
        });
    }

    public function testLoaderKeyword()
    {
        $this->when(function ($proxy, $serv) {

            $keywordId = $this->uniqueString();
            $return    = [SmokeFindingService::class, [
                'id'
                    => $keywordId
            ], [
                'id'
                    => '{{keyword_id}}'
            ]];

            $proxy->data->put('keyword_id', $keywordId);

            $this->verifyLoader($serv, 'keyword', $return);
        });
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->create();
            $keyword  = $this->factory(Obj::class)->create();

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('keyword', $keyword);

            $return = $this->resolveLoader($serv, 'result');

            $this->assertEquals($authUser->getKey(), $return->{UserSelfKwdPvt::USER_ID});
            $this->assertEquals($keyword->getKey(), $return->{UserSelfKwdPvt::KEYWORD_ID});
        });
    }

}