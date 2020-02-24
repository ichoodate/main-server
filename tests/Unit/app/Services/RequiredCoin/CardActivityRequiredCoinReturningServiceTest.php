<?php

namespace Tests\Unit\App\Services\RequiredCoin;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\User;
use App\Services\NowTimezoneService;
use App\Services\Card\CardFindingService;
use App\Services\RequiredCoin\RequiredCoinReturningService;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class CardActivityRequiredCoinReturningServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'card'
                => 'card for {{card_id}}',

            'card_flip'
                => 'flip status acted by {{auth_user}} for {{card}}',

            'match'
                => 'match of {{card}}',

            'match_open'
                => 'profile open status acted by matching users of {{card}}',

            'match_propose'
                => 'propose status acted by matching users of {{card}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'card_flip'
                => ['null_if:{{type}},' . Activity::TYPE_CARD_FLIP, 'not_null_if:{{type}},' . Activity::TYPE_CARD_OPEN],

            'card_id'
                => ['required', 'integer'],

            'match_open'
                => ['null_if:{{type}},' . Activity::TYPE_CARD_OPEN, 'not_null_if:{{type}},' . Activity::TYPE_CARD_PROPOSE],

            'match_propose'
                => ['null_if:{{type}},' . Activity::TYPE_CARD_PROPOSE],

            'type'
                => ['in:' . implode(',', [Activity::TYPE_CARD_FLIP, Activity::TYPE_CARD_OPEN, Activity::TYPE_CARD_PROPOSE])]
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([
            NowTimezoneService::class,
            RequiredCoinReturningService::class
        ]);
    }

    public function testLoaderCard()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $cardId   = $this->uniqueString();
            $return   = [CardFindingService::class, [
                'auth_user'
                    => $authUser,
                'id'
                    => $cardId
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'id'
                    => '{{card_id}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_id', $cardId);

            $this->verifyLoader($serv, 'card', $return);
        });
    }

    public function testLoaderCardFlip()
    {
        $this->when(function ($proxy, $serv) {

            $inst     = $this->mMock();
            $query    = $this->mMock();
            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $return   = $this->uniqueString();

            InstanceMocker::add(Activity::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::qWhere($query, Activity::RELATED_ID, $card->getKey());
            QueryMocker::qWhere($query, Activity::USER_ID, $authUser->getKey());
            QueryMocker::qWhere($query, Activity::TYPE, Activity::TYPE_CARD_FLIP);
            QueryMocker::first($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'card_flip', $return);
        });
    }

    public function testLoaderMatchOpen()
    {
        $this->when(function ($proxy, $serv) {

            $inst     = $this->mMock();
            $query    = $this->mMock();
            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $return   = $this->uniqueString();

            InstanceMocker::add(Activity::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::qWhere($query, Activity::RELATED_ID, $card->{Card::MATCH_ID});
            QueryMocker::qWhere($query, Activity::USER_ID, $authUser->getKey());
            QueryMocker::qWhere($query, Activity::TYPE, Activity::TYPE_MATCH_OPEN);
            QueryMocker::first($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'match_open', $return);
        });
    }

    public function testLoaderMatchPropose()
    {
        $this->when(function ($proxy, $serv) {

            $inst     = $this->mMock();
            $query    = $this->mMock();
            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $return   = $this->uniqueString();

            InstanceMocker::add(Activity::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::qWhere($query, Activity::RELATED_ID, $card->{Card::MATCH_ID});
            QueryMocker::qWhere($query, Activity::USER_ID, $authUser->getKey());
            QueryMocker::qWhere($query, Activity::TYPE, Activity::TYPE_MATCH_PROPOSE);
            QueryMocker::first($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'match_propose', $return);
        });
    }

    public function testLoaderEvaluatedCount()
    {
        $this->when(function ($proxy, $serv) {

            $return         = $this->uniqueString();
            $type           = $this->uniqueString();
            $limitedMinTime = $this->uniqueString();
            $subInst        = $this->mMock();
            $subQuery       = $this->mMock();
            $subBaseQuery   = $this->mMock();
            $inst           = $this->mMock();
            $query          = $this->mMock();
            $authUser       = $this->factory(User::class)->make();
            $card           = $this->factory(Card::class)->make([Card::CHOOSER_ID => $authUser->getKey()]);

            InstanceMocker::add(Card::class, $subInst);
            ModelMocker::query($subInst, $subQuery);
            QueryMocker::qSelect($subQuery, [Card::ID]);
            QueryMocker::qWhere($subQuery, Card::GROUP_ID, $card->{Card::GROUP_ID});
            QueryMocker::getQuery($subQuery, $subBaseQuery);

            InstanceMocker::add(Activity::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::lockForUpdate($query);
            QueryMocker::qWhereIn($query, Activity::RELATED_ID, $subBaseQuery);
            QueryMocker::qWhere($query, Activity::USER_ID, $authUser->getKey());
            QueryMocker::qWhere($query, Activity::TYPE, $type);
            QueryMocker::count($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('limited_min_time', $limitedMinTime);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'evaluated_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $inst           = $this->mMock();
            $query          = $this->mMock();
            $return         = $this->uniqueString();
            $type           = $this->uniqueString();
            $limitedMinTime = $this->uniqueString();
            $authUser       = $this->factory(User::class)->make();
            $card           = $this->factory(Card::class)->make([Card::SHOWNER_ID => $authUser->getKey()]);

            InstanceMocker::add(Activity::class, $inst);
            ModelMocker::query($inst, $query);
            QueryMocker::lockForUpdate($query);
            QueryMocker::qWhere($query, Activity::USER_ID, $authUser->getKey()) ;
            QueryMocker::qWhere($query, Activity::TYPE, $type);
            QueryMocker::qWhereOp($query, Activity::CREATED_AT, '>=', $limitedMinTime);
            QueryMocker::count($query, $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('limited_min_time', $limitedMinTime);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'evaluated_count', $return);
        });
    }

    public function testLoaderEvaluatedTime()
    {
        $this->when(function ($proxy, $serv) {

            $timezone  = 'Asia/Seoul';
            $isChooser = true;
            $card      = $this->factory(Card::class)->make([Card::CREATED_AT => '2018-11-12 11:22:33']);
            $return    = '2018-11-12 20:22:33';

            $proxy->data->put('timezone', $timezone);
            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'evaluated_time', $return);
        });

        $this->when(function ($proxy, $serv) {

            $timezone  = 'Asia/Seoul';
            $isChooser = false;
            $card      = $this->factory(Card::class)->make([Card::UPDATED_AT => '2018-11-12 11:22:33']);
            $return    = '2018-11-12 20:22:33';

            $proxy->data->put('timezone', $timezone);
            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'evaluated_time', $return);
        });
    }

    public function testLoaderIsFree()
    {
        $this->when(function ($proxy, $serv) {

            $isFreeCount = true;
            $isFreeTime  = true;
            $return      = true;

            $proxy->data->put('is_free_count', $isFreeCount);
            $proxy->data->put('is_free_time', $isFreeTime);

            $this->verifyLoader($serv, 'is_free', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isFreeCount = true;
            $isFreeTime  = false;
            $return      = false;

            $proxy->data->put('is_free_count', $isFreeCount);
            $proxy->data->put('is_free_time', $isFreeTime);

            $this->verifyLoader($serv, 'is_free', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isFreeCount = false;
            $isFreeTime  = true;
            $return      = false;

            $proxy->data->put('is_free_count', $isFreeCount);
            $proxy->data->put('is_free_time', $isFreeTime);

            $this->verifyLoader($serv, 'is_free', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isFreeCount = false;
            $isFreeTime  = false;
            $return      = false;

            $proxy->data->put('is_free_count', $isFreeCount);
            $proxy->data->put('is_free_time', $isFreeTime);

            $this->verifyLoader($serv, 'is_free', $return);
        });
    }

    public function testLoaderIsFreeCount()
    {
        $this->when(function ($proxy, $serv) {

            $limitedMaxCount = 3;
            $evaluatedCount  = 2;
            $return          = true;

            $proxy->data->put('limited_max_count', $limitedMaxCount);
            $proxy->data->put('evaluated_count', $evaluatedCount);

            $this->verifyLoader($serv, 'is_free_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $limitedMaxCount = 3;
            $evaluatedCount  = 4;
            $return          = false;

            $proxy->data->put('limited_max_count', $limitedMaxCount);
            $proxy->data->put('evaluated_count', $evaluatedCount);

            $this->verifyLoader($serv, 'is_free_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $limitedMaxCount = 3;
            $evaluatedCount  = 3;
            $return          = false;

            $proxy->data->put('limited_max_count', $limitedMaxCount);
            $proxy->data->put('evaluated_count', $evaluatedCount);

            $this->verifyLoader($serv, 'is_free_count', $return);
        });
    }

    public function testLoaderIsFreeTime()
    {
        $this->when(function ($proxy, $serv) {

            $limitedMinTime = '2018-01-01 11:22:33';
            $evaluatedTime  = '2018-01-01 11:22:32';
            $return         = false;

            $proxy->data->put('limited_min_time', $limitedMinTime);
            $proxy->data->put('evaluated_time', $evaluatedTime);

            $this->verifyLoader($serv, 'is_free_time', $return);
        });

        $this->when(function ($proxy, $serv) {

            $limitedMinTime = '2018-01-01 11:22:33';
            $evaluatedTime  = '2018-01-01 11:22:33';
            $return         = true;

            $proxy->data->put('limited_min_time', $limitedMinTime);
            $proxy->data->put('evaluated_time', $evaluatedTime);

            $this->verifyLoader($serv, 'is_free_time', $return);
        });

        $this->when(function ($proxy, $serv) {

            $limitedMinTime = '2018-01-01 11:22:33';
            $evaluatedTime  = '2018-01-01 11:22:34';
            $return         = true;

            $proxy->data->put('limited_min_time', $limitedMinTime);
            $proxy->data->put('evaluated_time', $evaluatedTime);

            $this->verifyLoader($serv, 'is_free_time', $return);
        });
    }

    public function testLoaderIsChooser()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $return   = false;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'is_chooser', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make([Card::SHOWNER_ID => $authUser->getKey()]);
            $return   = false;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'is_chooser', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make([Card::CHOOSER_ID => $authUser->getKey()]);
            $return   = true;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);

            $this->verifyLoader($serv, 'is_chooser', $return);
        });
    }

    public function testLoaderLimitedMaxCount()
    {
        $this->when(function ($proxy, $serv) {

            $isChooser = true;
            $type      = Activity::TYPE_CARD_FLIP;
            $return    = 2;

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'limited_max_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isChooser = true;
            $type      = Activity::TYPE_CARD_OPEN;
            $return    = 1;

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'limited_max_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isChooser = true;
            $type      = Activity::TYPE_CARD_PROPOSE;
            $return    = 1;

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'limited_max_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isChooser = false;
            $type      = Activity::TYPE_CARD_FLIP;
            $return    = INF;

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'limited_max_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isChooser = false;
            $type      = Activity::TYPE_CARD_OPEN;
            $return    = INF;

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'limited_max_count', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isChooser = false;
            $type      = Activity::TYPE_CARD_PROPOSE;
            $return    = INF;

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'limited_max_count', $return);
        });
    }

    public function testLoaderLimitedMinTime()
    {
        $this->when(function ($proxy, $serv) {

            $isChooser       = true;
            $nowTimezoneTime = '2018-11-21 11:22:33';
            $return          = '2018-11-21 00:00:00';

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('now_timezone_time', $nowTimezoneTime);

            $this->verifyLoader($serv, 'limited_min_time', $return);
        });

        $this->when(function ($proxy, $serv) {

            $isChooser       = false;
            $nowTimezoneTime = '2018-11-22 11:22:33';
            $return          = '2018-11-21 11:22:34';

            $proxy->data->put('is_chooser', $isChooser);
            $proxy->data->put('now_timezone_time', $nowTimezoneTime);

            $this->verifyLoader($serv, 'limited_min_time', $return);
        });
    }

    public function testLoaderPrice()
    {
        $this->when(function ($proxy, $serv) {

            $type   = Activity::TYPE_CARD_FLIP;
            $return = 5;

            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'price', $return);
        });

        $this->when(function ($proxy, $serv) {

            $type   = Activity::TYPE_CARD_OPEN;
            $return = 5;

            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'price', $return);
        });

        $this->when(function ($proxy, $serv) {

            $type   = Activity::TYPE_CARD_PROPOSE;
            $return = 5;

            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'price', $return);
        });
    }

}
