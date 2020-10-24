<?php

namespace Tests\Unit\App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\MatchAct;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Card\CardFindingService;
use App\Services\Match\MatchFindingService;
use App\Services\ListingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class CardListingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'card_type'
                => ['in:' . implode(',', static::class()::CARD_TYPE_VALUES)],

            'match_status'
                => ['in:' . implode(',', static::class()::USER_STATUS_VALUES)],

            'matching_user_status'
                => ['in:' . implode(',', static::class()::USER_STATUS_VALUES)],

            'auth_user_status'
                => ['in:' . implode(',', static::class()::USER_STATUS_VALUES)]
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

            $query              = $this->mMock();
            $queryBuilder1      = $this->mMock();
            $user               = $this->mMock();
            $userQuery          = $this->mMock();
            $userQueryBase      = $this->mMock();
            $authUserQuery      = $this->mMock();
            $matchingUserQuery  = $this->mMock();
            $matchStatus        = $this->uniqueString();
            $authUserStatus     = null;
            $matchingUserStatus = null;

            InstanceMocker::add(User::class, $user);
            ModelMocker::query($user, $userQuery);
            QueryMocker::qSelect($userQuery, User::ID);
            QueryMocker::qWhereIn($userQuery, User::ID, $matchingUserQuery);
            QueryMocker::qOrWhereIn($userQuery, User::ID, $authUserQuery);
            QueryMocker::getQuery($userQuery, $userQueryBase);

            $queryBuilder1->shouldReceive('call')->with($serv, $query, $userQueryBase, $matchStatus)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('query_builder_1', $queryBuilder1);
            $proxy->data->put('auth_user_query', $authUserQuery);
            $proxy->data->put('matching_user_query', $matchingUserQuery);
            $proxy->data->put('match_status', $matchStatus);
            $proxy->data->put('auth_user_status', $authUserStatus);
            $proxy->data->put('matching_user_status', $matchingUserStatus);

            $this->verifyCallback($serv, 'query.auth_user');
        });

        $this->when(function ($proxy, $serv) {

            $query              = $this->mMock();
            $queryBuilder1      = $this->mMock();
            $authUserQuery      = $this->mMock();
            $matchingUserQuery  = $this->mMock();
            $matchStatus        = null;
            $matchingUserStatus = null;
            $authUserStatus     = $this->uniqueString();

            $queryBuilder1->shouldReceive('call')->with($serv, $query, $authUserQuery, $authUserStatus)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('query_builder_1', $queryBuilder1);
            $proxy->data->put('auth_user_query', $authUserQuery);
            $proxy->data->put('matching_user_query', $matchingUserQuery);
            $proxy->data->put('match_status', $matchStatus);
            $proxy->data->put('auth_user_status', $authUserStatus);
            $proxy->data->put('matching_user_status', $matchingUserStatus);

            $this->verifyCallback($serv, 'query.auth_user');
        });

        $this->when(function ($proxy, $serv) {

            $query              = $this->mMock();
            $queryBuilder1      = $this->mMock();
            $authUserQuery      = $this->mMock();
            $matchingUserQuery  = $this->mMock();
            $authUserStatus     = null;
            $matchStatus        = null;
            $matchingUserStatus = $this->uniqueString();

            $queryBuilder1->shouldReceive('call')->with($serv, $query, $matchingUserQuery, $matchingUserStatus)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('query_builder_1', $queryBuilder1);
            $proxy->data->put('auth_user_query', $authUserQuery);
            $proxy->data->put('matching_user_query', $matchingUserQuery);
            $proxy->data->put('match_status', $matchStatus);
            $proxy->data->put('auth_user_status', $authUserStatus);
            $proxy->data->put('matching_user_status', $matchingUserStatus);

            $this->verifyCallback($serv, 'query.auth_user');
        });

        $this->when(function ($proxy, $serv) {

            $query              = $this->mMock();
            $queryBuilder1      = $this->mMock();
            $authUserQuery      = $this->mMock();
            $matchingUserQuery  = $this->mMock();
            $authUserStatus     = $this->uniqueString();
            $matchingUserStatus = $this->uniqueString();
            $matchStatus        = null;

            $queryBuilder1->shouldReceive('call')->with($serv, $query, $authUserQuery, $authUserStatus)->once();
            $queryBuilder1->shouldReceive('call')->with($serv, $query, $matchingUserQuery, $matchingUserStatus)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('query_builder_1', $queryBuilder1);
            $proxy->data->put('auth_user_query', $authUserQuery);
            $proxy->data->put('matching_user_query', $matchingUserQuery);
            $proxy->data->put('match_status', $matchStatus);
            $proxy->data->put('auth_user_status', $authUserStatus);
            $proxy->data->put('matching_user_status', $matchingUserStatus);

            $this->verifyCallback($serv, 'query.auth_user');
        });

        $this->when(function ($proxy, $serv) {

            $query             = $this->mMock();
            $queryBuilder1     = $this->mMock();
            $authUserQuery     = $this->mMock();
            $matchingUserQuery = $this->mMock();

            $queryBuilder1->shouldReceive('call')->with($serv, $query, $authUserQuery, null)->once();
            $queryBuilder1->shouldReceive('call')->with($serv, $query, $matchingUserQuery, null)->once();

            $proxy->data->put('query', $query);
            $proxy->data->put('query_builder_1', $queryBuilder1);
            $proxy->data->put('auth_user_query', $authUserQuery);
            $proxy->data->put('matching_user_query', $matchingUserQuery);

            $this->verifyCallback($serv, 'query.auth_user');
        });
    }

    public function testLoaderAuthUserIdField()
    {
        $this->when(function ($proxy, $serv) {

            $return   = Match::WOMAN_ID;
            $authUser = $this->factory(User::class)->make([User::GENDER => User::GENDER_WOMAN]);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'auth_user_id_field', $return);
        });

        $this->when(function ($proxy, $serv) {

            $return   = Match::MAN_ID;
            $authUser = $this->factory(User::class)->make([User::GENDER => User::GENDER_MAN]);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'auth_user_id_field', $return);
        });
    }

    public function testLoaderAuthUserQuery()
    {
        $this->when(function ($proxy, $serv) {

            $authUser  = $this->factory(User::class)->make();
            $user      = $this->mMock();
            $userQuery = $this->mMock();
            $return    = $this->uniqueString();

            InstanceMocker::add(User::class, $user);
            ModelMocker::query($user, $userQuery);
            QueryMocker::qSelect($userQuery, User::ID);
            QueryMocker::qWhere($userQuery, User::ID, $authUser->getKey());
            QueryMocker::getQuery($userQuery, $return);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'auth_user_query', $return);
        });
    }

    public function testLoaderCardType()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'card_type', static::class()::CARD_TYPE_BOTH);
        });
    }

    public function testLoaderCursor()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->uniqueString();
            $id       = $this->uniqueString();
            $return   = [CardFindingService::class, [
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

    public function testLoaderMatchingUserQuery()
    {
        $this->when(function ($proxy, $serv) {

            $authUser  = $this->factory(User::class)->make();
            $card      = $this->mMock();
            $cardQuery = $this->mMock();
            $return    = $this->uniqueString();

            InstanceMocker::add(Card::class, $card);
            ModelMocker::query($card, $cardQuery);
            QueryMocker::qSelect($cardQuery, Card::SHOWNER_ID);
            QueryMocker::qWhere($cardQuery, Card::CHOOSER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', static::class()::CARD_TYPE_CHOOSER);

            $this->verifyLoader($serv, 'matching_user_query', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser  = $this->factory(User::class)->make();
            $card      = $this->mMock();
            $cardQuery = $this->mMock();
            $return    = $this->uniqueString();

            InstanceMocker::add(Card::class, $card);
            ModelMocker::query($card, $cardQuery);
            QueryMocker::qSelect($cardQuery, Card::CHOOSER_ID);
            QueryMocker::qWhere($cardQuery, Card::SHOWNER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', static::class()::CARD_TYPE_SHOWNER);

            $this->verifyLoader($serv, 'matching_user_query', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser       = $this->factory(User::class)->make();
            $user           = $this->mMock();
            $userQuery      = $this->mMock();
            $return         = $this->mMock();
            $card           = $this->mMock();
            $cardQuery      = $this->mMock();
            $cardQueryBase  = $this->mMock();
            $card2          = $this->mMock();
            $cardQuery2     = $this->mMock();
            $cardQueryBase2 = $this->mMock();

            InstanceMocker::add(Card::class, $card);
            ModelMocker::query($card, $cardQuery);
            QueryMocker::qSelect($cardQuery, Card::SHOWNER_ID);
            QueryMocker::qWhere($cardQuery, Card::CHOOSER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery, $cardQueryBase);
            InstanceMocker::add(Card::class, $card2);
            ModelMocker::query($card2, $cardQuery2);
            QueryMocker::qSelect($cardQuery2, Card::CHOOSER_ID);
            QueryMocker::qWhere($cardQuery2, Card::SHOWNER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery2, $cardQueryBase2);

            InstanceMocker::add(User::class, $user);
            ModelMocker::query($user, $userQuery);
            QueryMocker::qSelect($userQuery, User::ID);
            QueryMocker::qWhereIn($userQuery, User::ID, $cardQueryBase);
            QueryMocker::qOrWhereIn($userQuery, User::ID, $cardQueryBase2);
            QueryMocker::getQuery($userQuery, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', static::class()::CARD_TYPE_BOTH);

            $this->verifyLoader($serv, 'matching_user_query', $return);
        });
    }

    public function testLoaderModelClass()
    {
        $this->when(function ($proxy, $serv) {

            $this->verifyLoader($serv, 'model_class', Card::class);
        });
    }

    public function testLoaderQuery()
    {
        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $authUserIdField = $this->uniqueString();
            $cardType        = static::class()::CARD_TYPE_CHOOSER;

            InstanceMocker::add(Card::class, $card = $this->mMock());

            ModelMocker::query($card, $cardQuery = $this->mMock());
            QueryMocker::qWhere($cardQuery, Card::CHOOSER_ID, $authUser->getKey());

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', $cardType);
            $proxy->data->put('auth_user_id_field', $authUserIdField);

            $this->verifyLoader($serv, 'query', $cardQuery);
        });

        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $authUserIdField = $this->uniqueString();
            $cardType        = static::class()::CARD_TYPE_SHOWNER;

            InstanceMocker::add(Card::class, $card = $this->mMock());

            ModelMocker::query($card, $cardQuery = $this->mMock());
            QueryMocker::qWhere($cardQuery, Card::SHOWNER_ID, $authUser->getKey());

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', $cardType);
            $proxy->data->put('auth_user_id_field', $authUserIdField);

            $this->verifyLoader($serv, 'query', $cardQuery);
        });

        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $authUserIdField = $this->uniqueString();
            $cardType        = static::class()::CARD_TYPE_BOTH;

            InstanceMocker::add(Card::class, $card = $this->mMock());
            InstanceMocker::add(Match::class, $match = $this->mMock());

            ModelMocker::query($card, $cardQuery = $this->mMock());
            ModelMocker::query($match, $matchQuery = $this->mMock());
            QueryMocker::qWhere($matchQuery, $authUserIdField, $authUser->getKey());
            QueryMocker::relatedQuery($matchQuery, 'selectId', $matchIdQuery = $this->mMock());
            QueryMocker::qWhereIn($cardQuery, Card::MATCH_ID, $matchIdQuery);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', $cardType);
            $proxy->data->put('auth_user_id_field', $authUserIdField);

            $this->verifyLoader($serv, 'query', $cardQuery);
        });
    }

    public function testLoaderQueryBuilder1()
    {
        $this->when(function ($proxy, $serv) {

            $userQuery     = $this->mMock();
            $cardQuery     = $this->mMock();
            $queryBuilder2 = $this->mMock();
            $result        = $this->mMock();

            QueryMocker::getQuery($cardQuery, $result);

            $proxy->data->put('query_builder_2', $queryBuilder2);

            $this->verifyLoader($serv, 'query_builder_1', $result, [$cardQuery, $userQuery, static::class()::USER_STATUS_ALL]);
        });

        $this->when($func = function ($proxy, $serv, $userStatus) {

            $userQuery     = $this->mMock();
            $cardQuery     = $this->mMock();
            $cardIdQuery   = $this->mMock();
            $queryBuilder2 = $this->mMock();
            $result        = $this->mMock();

            $queryBuilder2->shouldReceive('call')->with($serv, $userQuery, $userStatus)->once()->andReturn($cardIdQuery);

            QueryMocker::qWhereIn($cardQuery, Card::ID, $cardIdQuery);
            QueryMocker::getQuery($cardQuery, $result);

            $proxy->data->put('query_builder_2', $queryBuilder2);

            $this->verifyLoader($serv, 'query_builder_1', $result, [$cardQuery, $userQuery, $userStatus]);
        }, static::class()::USER_STATUS_CARD_FLIP);

        $this->when($func, static::class()::USER_STATUS_CARD_OPEN);
        $this->when($func, static::class()::USER_STATUS_CARD_PROPOSE);

        $this->when(function ($proxy, $serv) {

            $userQuery     = $this->mMock();
            $cardQuery     = $this->mMock();
            $cardIdQuery   = $this->mMock();
            $queryBuilder2 = $this->mMock();
            $result        = $this->mMock();

            $queryBuilder2->shouldReceive('call')->with($serv, $userQuery, static::class()::USER_STATUS_CARD_FLIP)->once()->andReturn($cardIdQuery);

            QueryMocker::qWhereNotIn($cardQuery, Card::ID, $cardIdQuery);
            QueryMocker::getQuery($cardQuery, $result);

            $proxy->data->put('query_builder_2', $queryBuilder2);

            $this->verifyLoader($serv, 'query_builder_1', $result, [$cardQuery, $userQuery, static::class()::USER_STATUS_CARD_FLIP_STEP]);
        });

        $this->when($func = function ($proxy, $serv, $userStatus, $userInStatus, $userNotInStatus) {

            $userQuery      = $this->mMock();
            $cardQuery      = $this->mMock();
            $cardIdQuery    = $this->mMock();
            $cardNotIdQuery = $this->mMock();
            $queryBuilder2  = $this->mMock();
            $result         = $this->mMock();

            $queryBuilder2->shouldReceive('call')->with($serv, $userQuery, $userInStatus)->once()->andReturn($cardIdQuery);
            $queryBuilder2->shouldReceive('call')->with($serv, $userQuery, $userNotInStatus)->once()->andReturn($cardNotIdQuery);

            QueryMocker::qWhereIn($cardQuery, Card::ID, $cardIdQuery);
            QueryMocker::qWhereNotIn($cardQuery, Card::ID, $cardNotIdQuery);
            QueryMocker::getQuery($cardQuery, $result);

            $proxy->data->put('query_builder_2', $queryBuilder2);

            $this->verifyLoader($serv, 'query_builder_1', $result, [$cardQuery, $userQuery, $userStatus]);
        }, static::class()::USER_STATUS_CARD_OPEN_STEP, static::class()::USER_STATUS_CARD_FLIP, static::class()::USER_STATUS_CARD_OPEN);

        $this->when($func, static::class()::USER_STATUS_CARD_PROPOSE_STEP, static::class()::USER_STATUS_CARD_OPEN, static::class()::USER_STATUS_CARD_PROPOSE);
    }

    public function testLoaderQueryBuilder2()
    {
        $this->when($func = function ($proxy, $serv, $userStatus, $activityType) {

            $userQuery     = $this->mMock();
            $activity      = $this->mMock();
            $activityQuery = $this->mMock();
            $return        = $this->mMock();

            InstanceMocker::add(CardFlip::class, $activity);

            ModelMocker::query($activity, $activityQuery);
            QueryMocker::qSelect($activityQuery, CardFlip::RELATED_ID);
            QueryMocker::qWhere($activityQuery, CardFlip::TYPE, $activityType);
            QueryMocker::qWhereIn($activityQuery, CardFlip::USER_ID, $userQuery);
            QueryMocker::getQuery($activityQuery, $return);

            $this->verifyLoader($serv, 'query_builder_2', $return, [$userQuery, $userStatus]);
        }, static::class()::USER_STATUS_CARD_FLIP, CardFlip::TYPE_CARD_FLIP);

        $this->when($func, static::class()::USER_STATUS_CARD_OPEN, CardFlip::TYPE_CARD_OPEN);
        $this->when($func, static::class()::USER_STATUS_CARD_PROPOSE, CardFlip::TYPE_CARD_PROPOSE);
    }

}
