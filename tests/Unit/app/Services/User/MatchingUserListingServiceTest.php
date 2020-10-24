<?php

namespace Tests\Unit\App\Services\User;

use App\Database\Collection;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Services\RandommingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class MatchingUserListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'keyword_ids'
                => ['required', 'integers'],
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            RandommingService::class
        ]);
    }

    public function testCallbackQueryKeywords()
    {
        $this->when(function ($proxy, $serv) {

            $query               = $this->mMock();
            $user                = $this->mMock();
            $userQuery           = $this->mMock();
            $userSelfKwdPvt          = $this->mMock();
            $userSelfKwdPvtQuery     = $this->mMock();
            $keywords            = $this->mMock();
            $keywordIds          = $this->uniqueString();
            $matchingGender      = $this->uniqueString();
            $userBaseQuery       = $this->uniqueString();
            $userSelfKwdPvtBaseQuery = $this->uniqueString();

            CollectionMocker::modelKeys($keywords, $keywordIds);
            InstanceMocker::add(UserSelfKwdPvt::class, $userSelfKwdPvt);
            ModelMocker::query($user, $userQuery);
            QueryMocker::qWhere($userQuery, User::GENDER, $matchingGender);
            QueryMocker::getQuery($userQuery, $userBaseQuery);
            InstanceMocker::add(User::class, $user);
            ModelMocker::query($userSelfKwdPvt, $userSelfKwdPvtQuery);
            QueryMocker::qSelect($userSelfKwdPvtQuery, UserSelfKwdPvt::USER_ID);
            QueryMocker::qGroupBy($userSelfKwdPvtQuery, UserSelfKwdPvt::USER_ID);
            QueryMocker::qWhereIn($userSelfKwdPvtQuery, UserSelfKwdPvt::KEYWORD_ID, $keywordIds);
            QueryMocker::qWhereIn($userSelfKwdPvtQuery, UserSelfKwdPvt::USER_ID, $userBaseQuery);
            QueryMocker::orderByRaw($userSelfKwdPvtQuery, 'count(*) desc');
            QueryMocker::limit($userSelfKwdPvtQuery, 1000);
            QueryMocker::getQuery($userSelfKwdPvtQuery, $userSelfKwdPvtBaseQuery);
            QueryMocker::qWhereIn($query, User::ID, $userSelfKwdPvtBaseQuery);
            QueryMocker::orderByRaw($query, 'rand()');

            $proxy->data->put('query', $query);
            $proxy->data->put('keywords', $keywords);
            $proxy->data->put('matching_gender', $matchingGender);

            $this->verifyCallback($serv, 'query.keywords');
        });

    }

    public function testLoaderKeywords()
    {
        $this->when(function ($proxy, $serv) {

            $obj      = $this->mMock();
            $objQuery = $this->mMock();
            $obj1     = $this->factory(Obj::class)->make();
            $obj2     = $this->factory(Obj::class)->make();
            $obj3     = $this->factory(Obj::class)->make();
            $list     = inst(Collection::class, [[$obj1, $obj2]]);
            $ids      = $obj2->getKey().','.$obj3->getKey().','.$obj1->getKey();
            $return   = inst(Collection::class, [[$obj2, null, $obj1]]);

            InstanceMocker::add(Obj::class, $obj);
            ModelMocker::query($obj, $objQuery);
            QueryMocker::qWhereIn($objQuery, Obj::ID, [$obj2->getKey(), $obj3->getKey(), $obj1->getKey()]);
            QueryMocker::qWhereIn($objQuery, Obj::TYPE, Obj::TYPE_KEYWORD_VALUES);
            QueryMocker::get($objQuery, $list);

            $proxy->data->put('keyword_ids', $ids);

            $this->verifyLoader($serv, 'keywords', $return);
        });
    }

    public function testLoaderMatchingGender()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make([
                User::GENDER => User::GENDER_MAN
            ]);
            $return = User::GENDER_WOMAN;

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'matching_gender', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make([
                User::GENDER => User::GENDER_WOMAN
            ]);
            $return = User::GENDER_MAN;

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'matching_gender', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', User::class);
        });
    }

}
