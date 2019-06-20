<?php

namespace Tests\Unit\App\Services\CardGroup;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\CardGroup\CardGroupCreatingService;
use App\Services\NowTimezoneService;
use App\Services\User\MatchingUserRandommingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Database\Collections\_Mocker as CollectionMocker;
use Tests\Unit\App\Services\_TestCase;

class TodayCardGroupCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'today_card_group'
                => 'card group created within {{local_date}} date',

            'user_ideal_type_kwd_pvt_keyword_ids'
                => 'ideal type keyword ids of {{auth_user}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'today_card_group'
                => ['null']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            CardGroupCreatingService::class,
            NowTimezoneService::class
        ]);
    }

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $return   = $this->mMock();

            ModelMocker::create(CardGroup::class, [
                CardGroup::USER_ID => $authUser->getKey(),
                CardGroup::TYPE => CardGroup::TYPE_DAILY
            ], $return);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderDailyCardGroup()
    {
        $this->when(function ($proxy, $serv) {

            $authUser             = $this->factory(User::class)->make();
            $nowTimezoneDateToUtc = new \DateTime;
            $cardGroup            = $this->mMock();
            $cardGroupQuery       = $this->mMock();
            $cardGroupBaseQuery   = $this->mMock();
            $cardGroup2           = $this->mMock();
            $cardGroupQuery2      = $this->mMock();
            $return               = $this->uniqueString();

            InstanceMocker::add(CardGroup::class, $cardGroup);
            ModelMocker::query($cardGroup, $cardGroupQuery);
            QueryMocker::qSelect($cardGroupQuery, CardGroup::ID);
            QueryMocker::qWhere($cardGroupQuery, CardGroup::USER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardGroupQuery, $cardGroupBaseQuery);

            InstanceMocker::add(CardGroup::class, $cardGroup2);
            ModelMocker::query($cardGroup2, $cardGroupQuery2);
            QueryMocker::qWhereIn($cardGroupQuery2, CardGroup::ID, $cardGroupBaseQuery);
            QueryMocker::qWhere($cardGroupQuery2, CardGroup::TYPE, CardGroup::TYPE_DAILY);
            QueryMocker::qWhereOp($cardGroupQuery2, CardGroup::CREATED_AT, '>=', $nowTimezoneDateToUtc->format('Y-m-d H:i:s'));
            QueryMocker::first($cardGroupQuery2, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('now_timezone_date_to_utc', $nowTimezoneDateToUtc);

            $this->verifyLoader($serv, 'today_card_group', $return);
        });
    }

    public function testLoaderUserIdealTypeKwdPvts()
    {
        $this->when(function ($proxy, $serv) {

            $return   = $this->uniqueString();
            $authUser = $this->factory(User::class)->make();
            $query    = $this->mMock();

            ModelMocker::query(UserIdealTypeKwdPvt::class, $query);
            QueryMocker::qWhere($query, UserIdealTypeKwdPvt::USER_ID, $authUser->getKey());
            QueryMocker::get($query, $return);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'user_ideal_type_kwd_pvts', $return);
        });
    }

    public function testLoaderUserIdealTypeKwdPvtKeywordIds()
    {
        $this->when(function ($proxy, $serv) {

            $userIdealTypeKwdPvts = $this->mMock();
            $return        = $userIdealTypeKwdPvts;

            CollectionMocker::pluck($userIdealTypeKwdPvts, UserIdealTypeKwdPvt::KEYWORD_ID);
            CollectionMocker::all($userIdealTypeKwdPvts);

            $proxy->data->put('user_ideal_type_kwd_pvts', $userIdealTypeKwdPvts);

            $this->verifyLoader($serv, 'user_ideal_type_kwd_pvt_keyword_ids', $return);
        });
    }

    public function testLoaderUsers()
    {
        $this->when(function ($proxy, $serv) {

            $keywordIds = [$this->uniqueString(), $this->uniqueString()];
            $localDate  = $this->uniqueString();
            $timezone   = $this->uniqueString();
            $return     = [MatchingUserRandommingService::class, [
                'keyword_ids'
                    => $keywordIds[0] . ',' . $keywordIds[1],
                'limit'
                    => 4
            ], [
                'keyword_ids'
                    => '{{user_ideal_type_kwd_pvt_keyword_ids}}'
            ]];

            $proxy->data->put('user_ideal_type_kwd_pvt_keyword_ids', $keywordIds);

            $this->verifyLoader($serv, 'users', $return);
        });
    }

    public function testLoaderUsersCount()
    {
        $this->when(function ($proxy, $serv) {

            $users  = $this->mMock();
            $count  = 4;
            $return = $count;

            CollectionMocker::count($users, $count);

            $proxy->data->put('users', $users);

            $this->verifyLoader($serv, 'users_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $users  = $this->mMock();
            $count  = 3;

            CollectionMocker::count($users, $count);

            $proxy->data->put('users', $users);

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'users_count');
            });
        });
    }

}
