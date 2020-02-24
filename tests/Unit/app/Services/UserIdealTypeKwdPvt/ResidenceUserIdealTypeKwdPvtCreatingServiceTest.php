<?php

namespace Tests\Unit\App\Services\UserIdealTypeKwdPvt;

use App\Database\Models\Obj;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\User;
use App\Database\Models\Keyword\Residence;
use App\Services\Keyword\Residence\ResidenceFindingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class ResidenceUserIdealTypeKwdPvtCreatingServiceTest extends _TestCase {

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

            $authUser           = $this->factory(User::class)->make();
            $residence          = $this->mMock();
            $residenceQuery     = $this->mMock();
            $residenceBaseQuery = $this->mMock();
            $kwdPvt             = $this->mMock();
            $kwdPvtQuery        = $this->mMock();
            $kwdPvtBaseQuery    = $this->mMock();

            InstanceMocker::add(Residence::class, $residence);
            ModelMocker::query($residence, $residenceQuery);
            QueryMocker::qSelect($residenceQuery, Residence::ID);
            QueryMocker::getQuery($residenceQuery, $residenceBaseQuery);

            InstanceMocker::add(UserIdealTypeKwdPvt::class, $kwdPvt);
            ModelMocker::query($kwdPvt, $kwdPvtQuery);
            QueryMocker::qWhere($kwdPvtQuery, UserIdealTypeKwdPvt::USER_ID, $authUser->getKey());
            QueryMocker::qWhereIn($kwdPvtQuery, UserIdealTypeKwdPvt::KEYWORD_ID, $residenceBaseQuery);
            QueryMocker::delete($kwdPvtQuery);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyCallback($serv, 'auth_user');
        });
    }

    public function testLoaderKeyword()
    {
        $this->when(function ($proxy, $serv) {

            $keywordId = $this->uniqueString();
            $return    = [ResidenceFindingService::class, [
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

            $this->assertEquals($authUser->getKey(), $return->{UserIdealTypeKwdPvt::USER_ID});
            $this->assertEquals($keyword->getKey(), $return->{UserIdealTypeKwdPvt::KEYWORD_ID});
        });
    }

}
