<?php

namespace Tests\Unit\App\Services\Card;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\CardAct;
use App\Database\Models\ChattingRoom;
use App\Database\Models\MatchAct;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Services\Card\CardPagingService as Serv;
use App\Services\Match\MatchFindingService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;
use Tests\Unit\App\Services\_TestCase;

class CardPagingServiceTest extends _TestCase {

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
                => ['required', 'in:' . implode(',', Serv::CARD_TYPE_VALUES)]
        ]);
    }

    public function testCallbackQueryAuthUser()
    {
        $this->when(function ($proxy, $serv) {

            $query              = $this->mMock();
            $queryBuilder1      = $this->mMock();
            $authUserQuery      = $this->mMock();
            $matchingUserQuery  = $this->mMock();
            $matchStatus        = $this->uniqueString();
            $authUserStatus     = null;
            $matchingUserStatus = null;

            QueryMocker::unionAll($matchingUserQuery, $authUserQuery);

            $queryBuilder1->shouldReceive('call')->with($serv, $query, $matchingUserQuery, $matchStatus)->once();

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
            ModelMocker::aliasQuery($user, $userQuery);
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

            $this->verifyLoader($serv, 'card_type', Serv::CARD_TYPE_BOTH);
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
            ModelMocker::aliasQuery($card, $cardQuery);
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
            ModelMocker::aliasQuery($card, $cardQuery);
            QueryMocker::qSelect($cardQuery, Card::CHOOSER_ID);
            QueryMocker::qWhere($cardQuery, Card::SHOWNER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', static::class()::CARD_TYPE_SHOWNER);

            $this->verifyLoader($serv, 'matching_user_query', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser       = $this->factory(User::class)->make();
            $card           = $this->mMock();
            $cardQuery      = $this->mMock();
            $cardQueryBase  = $this->mMock();
            $card2          = $this->mMock();
            $cardQuery2     = $this->mMock();
            $cardQueryBase2 = $this->mMock();

            InstanceMocker::add(Card::class, $card);
            ModelMocker::aliasQuery($card, $cardQuery);
            QueryMocker::qSelect($cardQuery, Card::SHOWNER_ID);
            QueryMocker::qWhere($cardQuery, Card::CHOOSER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery, $cardQueryBase);
            InstanceMocker::add(Card::class, $card2);
            ModelMocker::aliasQuery($card2, $cardQuery2);
            QueryMocker::qSelect($cardQuery2, Card::CHOOSER_ID);
            QueryMocker::qWhere($cardQuery2, Card::SHOWNER_ID, $authUser->getKey());
            QueryMocker::getQuery($cardQuery2, $cardQueryBase2);
            QueryMocker::unionAll($cardQueryBase, $cardQueryBase2);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', static::class()::CARD_TYPE_BOTH);

            $this->verifyLoader($serv, 'matching_user_query', $cardQueryBase);
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
            $cardType        = Serv::CARD_TYPE_CHOOSER;

            InstanceMocker::add(Card::class, $card = $this->mMock());

            ModelMocker::aliasQuery($card, $cardQuery = $this->mMock());
            QueryMocker::qWhere($cardQuery, Card::CHOOSER_ID, $authUser->getKey());

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', $cardType);
            $proxy->data->put('auth_user_id_field', $authUserIdField);

            $this->verifyLoader($serv, 'query', $cardQuery);
        });

        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $authUserIdField = $this->uniqueString();
            $cardType        = Serv::CARD_TYPE_SHOWNER;

            InstanceMocker::add(Card::class, $card = $this->mMock());

            ModelMocker::aliasQuery($card, $cardQuery = $this->mMock());
            QueryMocker::qWhere($cardQuery, Card::SHOWNER_ID, $authUser->getKey());

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_type', $cardType);
            $proxy->data->put('auth_user_id_field', $authUserIdField);

            $this->verifyLoader($serv, 'query', $cardQuery);
        });

        $this->when(function ($proxy, $serv) {

            $authUser        = $this->factory(User::class)->make();
            $authUserIdField = $this->uniqueString();
            $cardType        = Serv::CARD_TYPE_BOTH;

            InstanceMocker::add(Card::class, $card = $this->mMock());
            InstanceMocker::add(Match::class, $match = $this->mMock());

            ModelMocker::aliasQuery($card, $cardQuery = $this->mMock());
            ModelMocker::aliasQuery($match, $matchQuery = $this->mMock());
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

            $this->verifyLoader($serv, 'query_builder_1', $result, [$cardQuery, $userQuery, Serv::USER_STATUS_ALL]);
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
        }, Serv::USER_STATUS_CARD_FLIP);

        $this->when($func, Serv::USER_STATUS_CARD_OPEN);
        $this->when($func, Serv::USER_STATUS_CARD_PROPOSE);

        $this->when(function ($proxy, $serv) {

            $userQuery     = $this->mMock();
            $cardQuery     = $this->mMock();
            $cardIdQuery   = $this->mMock();
            $queryBuilder2 = $this->mMock();
            $result        = $this->mMock();

            $queryBuilder2->shouldReceive('call')->with($serv, $userQuery, Serv::USER_STATUS_CARD_FLIP)->once()->andReturn($cardIdQuery);

            QueryMocker::qWhereNotIn($cardQuery, Card::ID, $cardIdQuery);
            QueryMocker::getQuery($cardQuery, $result);

            $proxy->data->put('query_builder_2', $queryBuilder2);

            $this->verifyLoader($serv, 'query_builder_1', $result, [$cardQuery, $userQuery, Serv::USER_STATUS_CARD_FLIP_STEP]);
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
        }, Serv::USER_STATUS_CARD_OPEN_STEP, Serv::USER_STATUS_CARD_FLIP, Serv::USER_STATUS_CARD_OPEN);

        $this->when($func, Serv::USER_STATUS_CARD_PROPOSE_STEP, Serv::USER_STATUS_CARD_OPEN, Serv::USER_STATUS_CARD_PROPOSE);
    }

    public function testLoaderQueryBuilder2()
    {
        $this->when($func = function ($proxy, $serv, $userStatus, $activityType) {

            $userQuery     = $this->mMock();
            $activity      = $this->mMock();
            $activityQuery = $this->mMock();
            $return        = $this->mMock();

            InstanceMocker::add(Activity::class, $activity);

            ModelMocker::aliasQuery($activity, $activityQuery);
            QueryMocker::qSelect($activityQuery, Activity::RELATED_ID);
            QueryMocker::qWhere($activityQuery, Activity::TYPE, $activityType);
            QueryMocker::qWhereIn($activityQuery, Activity::USER_ID, $userQuery);
            QueryMocker::getQuery($activityQuery, $return);

            $this->verifyLoader($serv, 'query_builder_2', $return, [$userQuery, $userStatus]);
        }, Serv::USER_STATUS_CARD_FLIP, Activity::TYPE_CARD_FLIP);

        $this->when($func, Serv::USER_STATUS_CARD_OPEN, Activity::TYPE_CARD_OPEN);
        $this->when($func, Serv::USER_STATUS_CARD_PROPOSE, Activity::TYPE_CARD_PROPOSE);
    }

    public function testResult()
    {
        $namedIds = [];
        $rand = rand(0, 1);
        $user1 = $this->factory(User::class)->create([
            User::ID => 1,
            User::GENDER => $rand ? User::GENDER_MAN : User::GENDER_WOMAN
        ]);
        $user2 = $this->factory(User::class)->create([
            User::ID => 2,
            User::GENDER => $rand ? User::GENDER_WOMAN : User::GENDER_MAN
        ]);
        $user3 = $this->factory(User::class)->create([
            User::ID => 3,
            User::GENDER => $rand ? User::GENDER_MAN : User::GENDER_WOMAN
        ]);

        $this->factory(Match::class)->create([
            Match::MAN_ID => $rand ? 1 : 2,
            Match::WOMAN_ID => $rand ? 2 : 1,
            Match::CARDS => [[
                Card::ID => $namedIds['1_ch_none_2_sh_none'] = 201,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => []
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_none'] = 202,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_none'] = 203,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_none'] = 204,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_flip'] = 205,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_flip'] = 206,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_flip'] = 207,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1,
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_flip'] = 208,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_open'] = 209,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_open'] = 210,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_open'] = 211,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_open'] = 212,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_none_2_sh_prop'] = 213,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_flip_2_sh_prop'] = 214,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_open_2_sh_prop'] = 215,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['1_ch_prop_2_sh_prop'] = 216,
                Card::CHOOSER_ID => 1,
                Card::SHOWNER_ID => 2,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 1
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_PROPOSE,
                    Activity::USER_ID => 2
                ]]
            ], [
                Card::ID => $namedIds['2_ch_flip_1_sh_open'] = 217,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 1,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ]]
        ]);

        $this->factory(Match::class)->create([
            Match::MAN_ID => $rand ? 3 : 2,
            Match::WOMAN_ID => $rand ? 2 : 3,
            Match::CARDS => [[
                Card::ID => $namedIds['2_ch_flip_3_sh_open'] = 218,
                Card::CHOOSER_ID => 2,
                Card::SHOWNER_ID => 3,
                Card::ACTIVITIES => [[
                    Activity::TYPE => Activity::TYPE_CARD_FLIP,
                    Activity::USER_ID => 2
                ], [
                    Activity::TYPE => Activity::TYPE_CARD_OPEN,
                    Activity::USER_ID => 2
                ]]
            ]]
        ]);


        foreach ( [[ // 0
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none']
        ], [ // 1
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 2
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_none_2_sh_flip']
        ], [ // 3
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 4
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_none_2_sh_open']
        ], [ // 5
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_none_2_sh_prop']
        ], [ // 6
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_none_2_sh_prop']
        ], [ // 7
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 8
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 9
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 10
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 11
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 12
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 13
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_FLIP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 14
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_flip_2_sh_none']
        ], [ // 15
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_flip_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 16
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_flip_2_sh_flip']
        ], [ // 17
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 18
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_flip_2_sh_open']
        ], [ // 19
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_flip_2_sh_prop']
        ], [ // 20
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_flip_2_sh_none', '1_ch_flip_2_sh_flip', '1_ch_flip_2_sh_open', '1_ch_flip_2_sh_prop']
        ], [ // 21
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 22
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 23
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 24
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 25
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 26
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 27
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_OPEN,
            static::class()::USER_STATUS_ALL,
            ['1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 28
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_open_2_sh_none']
        ], [ // 29
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_open_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 30
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_open_2_sh_flip']
        ], [ // 31
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 32
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_open_2_sh_open']
        ], [ // 33
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_open_2_sh_prop']
        ], [ // 34
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_ALL,
            ['1_ch_open_2_sh_none', '1_ch_open_2_sh_flip', '1_ch_open_2_sh_open', '1_ch_open_2_sh_prop']
        ], [ // 35
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_prop_2_sh_none']
        ], [ // 36
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_prop_2_sh_flip', '1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 37
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_prop_2_sh_flip']
        ], [ // 38
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 39
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_prop_2_sh_open']
        ], [ // 40
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_prop_2_sh_prop']
        ], [ // 41
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE,
            static::class()::USER_STATUS_ALL,
            ['1_ch_prop_2_sh_none', '1_ch_prop_2_sh_flip', '1_ch_prop_2_sh_open', '1_ch_prop_2_sh_prop']
        ], [ // 42
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none']
        ], [ // 43
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_FLIP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 44
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_OPEN_STEP,
            ['1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip']
        ], [ // 45
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_OPEN,
            ['1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 46
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            ['1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open']
        ], [ // 47
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_CARD_PROPOSE,
            ['1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 48
            1,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop']
        ], [ // 49
            1,
            static::class()::CARD_TYPE_SHOWNER,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_ALL,
            ['2_ch_flip_1_sh_open']
        ], [ // 50
            1,
            static::class()::CARD_TYPE_BOTH,
            static::class()::USER_STATUS_ALL,
            static::class()::USER_STATUS_ALL,
            ['1_ch_none_2_sh_none', '1_ch_flip_2_sh_none', '1_ch_open_2_sh_none', '1_ch_prop_2_sh_none', '1_ch_none_2_sh_flip', '1_ch_flip_2_sh_flip', '1_ch_open_2_sh_flip', '1_ch_prop_2_sh_flip', '1_ch_none_2_sh_open', '1_ch_flip_2_sh_open', '1_ch_open_2_sh_open', '1_ch_prop_2_sh_open', '1_ch_none_2_sh_prop', '1_ch_flip_2_sh_prop', '1_ch_open_2_sh_prop', '1_ch_prop_2_sh_prop', '2_ch_flip_1_sh_open']
        ], [ // 51
            2,
            static::class()::CARD_TYPE_CHOOSER,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['2_ch_flip_1_sh_open', '2_ch_flip_3_sh_open']
        ], [ // 52
            2,
            static::class()::CARD_TYPE_BOTH,
            static::class()::USER_STATUS_CARD_PROPOSE_STEP,
            static::class()::USER_STATUS_CARD_FLIP_STEP,
            ['1_ch_none_2_sh_open', '2_ch_flip_1_sh_open', '2_ch_flip_3_sh_open']
        ]] as $i => $args )
        {
            $this->authUser           = User::find($args[0]);
            $this->cardType           = $args[1];
            $this->authUserStatus     = $args[2];
            $this->matchingUserStatus = $args[3];

            $expectIds = array_only($namedIds, $args[4]);

            $this->assertResult(Card::find($expectIds));
        }
    }

}
