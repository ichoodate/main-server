<?php

namespace Tests\Unit\App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\Coin;
use App\Database\Models\User;
use App\Services\Card\CardFindingService;
use App\Services\Activity\CardActivityCreatingService as Serv;
use App\Services\RequiredCoin\CardActivityRequiredCoinCountingService;
use Tests\Unit\App\Database\Models\_Mocker as ModelMocker;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Unit\App\Services\_TestCase;

class CardActivityCreatingServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'card'
                => 'card for {{card_id}}',

            'required_coin'
                => 'required coin for activity of {{card}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'card'
                => ['not_null'],

            'card_id'
                => ['required', 'integer'],

            'type'
                => ['in:' . implode(',', [Activity::TYPE_CARD_FLIP, Activity::TYPE_CARD_OPEN, Activity::TYPE_CARD_PROPOSE])],

            'timezone'
                => ['required']
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

    public function testLoaderCreated()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = $this->uniqueString();
            $return   = $this->mMock();

            ModelMocker::create(Activity::class, [
                Activity::USER_ID    => $authUser->getKey(),
                Activity::RELATED_ID => $card->getKey(),
                Activity::TYPE       => $type
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'created', $return);
        });
    }

    public function testLoaderMatchActivity()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = Activity::TYPE_CARD_FLIP;
            $return   = null;

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'match_activity', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = Activity::TYPE_CARD_OPEN;
            $return   = $this->mMock();

            InstanceMocker::add(Activity::class, $return);
            ModelMocker::create($return, [
                Activity::RELATED_ID => $card->{Card::MATCH_ID},
                Activity::USER_ID    => $authUser->getKey(),
                Activity::TYPE       => Activity::TYPE_MATCH_OPEN
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'match_activity', $return);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = Activity::TYPE_CARD_PROPOSE;
            $return   = $this->mMock();

            InstanceMocker::add(Activity::class, $return);
            ModelMocker::create($return, [
                Activity::RELATED_ID => $card->{Card::MATCH_ID},
                Activity::USER_ID    => $authUser->getKey(),
                Activity::TYPE       => Activity::TYPE_MATCH_PROPOSE
            ], $return);

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);

            $this->verifyLoader($serv, 'match_activity', $return);
        });
    }

    public function testLoaderRequiredCoin()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();
            $card     = $this->factory(Card::class)->make();
            $type     = $this->uniqueString();
            $timezone = $this->uniqueString();
            $return   = [CardActivityRequiredCoinCountingService::class, [
                'auth_user'
                    => $authUser,
                'card'
                    => $card,
                'card_id'
                    => $card->getKey(),
                'type'
                    => $type,
                'timezone'
                    => $timezone
            ], [
                'auth_user'
                    => '{{auth_user}}',
                'card'
                    => '{{card}}',
                'card_id'
                    => 'id of {{card}}',
                'type'
                    => '{{type}}',
                'timezone'
                    => '{{timezone}}'
            ]];

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);
            $proxy->data->put('timezone', $timezone);

            $this->verifyLoader($serv, 'required_coin', $return);
        });
    }

    public function testDataRequiredCoin()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->create(['id' => 1]);
            $card     = $this->factory(Card::class)->create(['id' => 11, 'chooser_id' => $authUser->getKey(), 'created_at' => '2001-01-01 11:22:33']);
            $type     = Activity::TYPE_CARD_FLIP;
            $timezone = 'Asia/Seoul';

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card', $card);
            $proxy->data->put('type', $type);
            $proxy->data->put('timezone', $timezone);

            $this->verifyData($proxy, 'required_coin', 5);
        });
    }

    public function testRun()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->create(['id' => 1]);
            $card     = $this->factory(Card::class)->create(['id' => 11, 'chooser_id' => $authUser->getKey(), 'created_at' => '2001-01-01 11:22:33']);
            $type     = Activity::TYPE_CARD_FLIP;
            $timezone = 'Asia/Seoul';

            $proxy->data->put('auth_user', $authUser);
            $proxy->data->put('card_id', $card->getKey());
            $proxy->data->put('type', $type);
            $proxy->data->put('timezone', $timezone);

            $result = $proxy->run();

            $activity = Activity::query()
                ->where('user_id', 1)
                ->where('related_id', 11)
                ->where('type', Activity::TYPE_CARD_FLIP)
                ->first();

            $this->assertNotNull($activity);
            $this->assertEquals($activity, $result->fresh());
            $this->assertTrue($proxy->data()->has('required_coin'));
            $this->assertNotEquals(0, $proxy->data()->get('required_coin'));
            $this->assertTrue($proxy->data()->has('used_coin'));
            $this->assertNotNull($proxy->data()->get('used_coin'));
        });
    }
}
