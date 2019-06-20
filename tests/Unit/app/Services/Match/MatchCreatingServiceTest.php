<?php

namespace Tests\Unit\App\Services\Match;

use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Services\_TestCase;

class MatchCreatingServiceTest extends _TestCase {

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
        $this->verifyArrTraits([]);
    }

    public function testLoaderAuthUserIdField()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make([User::GENDER => User::GENDER_WOMAN]);
            $return   = Match::WOMAN_ID;

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'auth_user_id_field', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make([User::GENDER => User::GENDER_MAN]);
            $return   = Match::MAN_ID;

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'auth_user_id_field', $return);
        });
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser            = $this->factory(User::class)->make();
            $newMatchingUserIds  = [11, 22];
            $return              = $this->mMock();
            $authUserIdField     = $this->uniqueString();
            $matchingUserIdField = $this->uniqueString();
            $newModel1           = $this->uniqueString();
            $newModel2           = $this->uniqueString();

            ModelMocker::newCollection(Match::class, $return);
            ModelMocker::create(Match::class, [
                $authUserIdField     => $authUser->getKey(),
                $matchingUserIdField => 11
            ], $newModel1);

            ModelMocker::create(Match::class, [
                $authUserIdField     => $authUser->getKey(),
                $matchingUserIdField => 22
            ], $newModel2);

            CollectionMocker::push($return, $newModel1);
            CollectionMocker::push($return, $newModel2);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('auth_user_id_field', $authUserIdField);
            $proxy->data->put('matching_user_id_field', $matchingUserIdField);
            $proxy->data->put('new_matching_user_ids', $newMatchingUserIds);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderExisted()
    {
        $this->when(function ($proxy, $serv) {

            $return              = $this->uniqueString();
            $query               = $this->mMock();
            $authUser            = $this->factory(User::class)->make();
            $authUserIdField     = $this->uniqueString();
            $matchingUserIdField = $this->uniqueString();
            $matchingUserIds     = $this->uniqueString();

            ModelMocker::query(Match::class, $query);
            QueryMocker::qWhere($query, $authUserIdField, $authUser->getKey());
            QueryMocker::qWhereIn($query, $matchingUserIdField, $matchingUserIds);
            QueryMocker::get($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('auth_user_id_field', $authUserIdField);
            $proxy->data->put('matching_user_id_field', $matchingUserIdField);
            $proxy->data->put('matching_user_ids', $matchingUserIds);

            $this->verifyLoader($serv, 'existed', $return);
        });
    }

    public function testLoaderExistedMatchingUserIds()
    {
        $this->when(function ($proxy, $serv) {

            $return              = $this->uniqueString();
            $matchingUserIdField = $this->uniqueString();
            $existed             = $this->mMock();
            $keywordIds          = $this->mMock();

            CollectionMocker::pluck($existed, $matchingUserIdField);
            CollectionMocker::all($existed, $return);

            $proxy->data->put('existed', $existed);
            $proxy->data->put('matching_user_id_field', $matchingUserIdField);

            $this->verifyLoader($serv, 'existed_matching_user_ids', $return);
        });
    }

    public function testLoaderMatchingUserIdField()
    {
        $this->when(function ($proxy, $serv) {

            $return   = Match::MAN_ID;
            $authUser = $this->factory(User::class)->make([User::GENDER => User::GENDER_WOMAN]);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'matching_user_id_field', $return);
        });

        $this->when(function ($proxy, $serv) {

            $return   = Match::WOMAN_ID;
            $authUser = $this->factory(User::class)->make([User::GENDER => User::GENDER_MAN]);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'matching_user_id_field', $return);
        });
    }

    public function testLoaderMatchingUserIds()
    {
        $this->when(function ($proxy, $serv) {

            $matchingUsers = $this->factory(User::class)->make([], 3);
            $return        = $matchingUsers->modelKeys();

            $proxy->data->put('matching_users', $matchingUsers);

            $this->verifyLoader($serv, 'matching_user_ids', $return);
        });
    }

    public function testLoaderNewMatchingUserIds()
    {
        $this->when(function ($proxy, $serv) {

            $matchingUserIds        = [1, 2, 3, 4, 5];
            $existedMatchingUserIds = [2, 4];
            $return                 = [1, 3, 5];

            $proxy->data->put('matching_user_ids', $matchingUserIds);
            $proxy->data->put('existed_matching_user_ids', $existedMatchingUserIds);

            $this->verifyLoader($serv, 'new_matching_user_ids', $return);
        });
    }

    public function testLoaderMatchingUsers()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'matching_users');
            });
        });
    }

}
