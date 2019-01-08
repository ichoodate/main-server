<?php

namespace Tests\Feature\App\Services\RequiredCoin;

use App\Database\Models\Card;
use App\Database\Models\User;
use App\Database\Models\Activity;
use Tests\_InstanceMocker as InstanceMocker;
use Tests\Feature\App\Services\_TestCase;

class CardActivityRequiredCoinCountingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => User::find($this->authUserId),
            'card_id'
                => $this->cardId,
            'type'
                => $this->type,
            'timezone'
                => $this->timezone
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => '[card_id]',
            'type'
                => '[type]',
            'timezone'
                => '[timezone]'
        ]];
    }

    public function testCardFlip()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id'         => 11,
            'chooser_id' => 1,
            'match_id'   => 21,
            'created_at' => (new \DateTime)->format('Y-m-d H:i:s')
        ]);

        $this->authUserId = 1;
        $this->cardId     = 11;
        $this->timezone   = 'UTC';
        $this->type       = Activity::TYPE_CARD_FLIP;
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 101,
            'related_id' => 11,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_FLIP
        ]);
        $this->assertError('flip status of card of [card_id] acted by authorized user must not exist.');
    }

    public function testMatchOpen()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id'         => 11,
            'chooser_id' => 1,
            'match_id'   => 21,
            'created_at' => (new \DateTime)->format('Y-m-d H:i:s')
        ]);
        $this->factory(Activity::class)->create([
            'id'         => 101,
            'related_id' => 11,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_FLIP
        ]);

        $this->authUserId = 1;
        $this->cardId = 11;
        $this->timezone = 'UTC';
        $this->type = Activity::TYPE_CARD_OPEN;
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 102,
            'related_id' => 21,
            'user_id'    => 1,
            'type'       => Activity::TYPE_MATCH_OPEN
        ]);
        $this->assertError('open status of card of [card_id] acted by authorized user must not exist.');
    }

    public function testMatchPropose()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id'         => 11,
            'chooser_id' => 1,
            'match_id'   => 21,
            'created_at' => (new \DateTime)->format('Y-m-d H:i:s')
        ]);
        $this->factory(Activity::class)->create([
            'id'         => 101,
            'related_id' => 11,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_FLIP
        ]);
        $this->factory(Activity::class)->create([
            'id'         => 102,
            'related_id' => 21,
            'user_id'    => 1,
            'type'       => Activity::TYPE_MATCH_OPEN
        ]);

        $this->authUserId = 1;
        $this->cardId = 11;
        $this->timezone = 'UTC';
        $this->type = Activity::TYPE_CARD_PROPOSE;
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 103,
            'related_id' => 21,
            'user_id'    => 1,
            'type'       => Activity::TYPE_MATCH_PROPOSE
        ]);
        $this->assertError('propose status of card of [card_id] acted by authorized user must not exist.');
    }

    public function testIsFreeTime()
    {
        InstanceMocker::add(\DateTime::class, $dateTime = (new \DateTime)->modify('15:00:00'), [], null);

        $this->when(function ($serv, $data) {

            $data->put('card', inst(Card::class, [[
                'chooser_id' => 1,
                'created_at' => (new \DateTime)->modify('14:59:59')->format('Y-m-d H:i:s')
            ]]));
            $data->put('timezone', 'UTC');


        });
        $this->assertResult(5);

        // showner case start
        $this->cardId = 12;
        $this->assertResult(0);

        InstanceMocker::add(\DateTime::class, $dateTime = (new \DateTime)->modify('14:59:58')->modify('+1 days'), [], null);
        $this->assertResult(0);

        InstanceMocker::add(\DateTime::class, $dateTime = (new \DateTime)->modify('14:59:59')->modify('+1 days'), [], null);
        $this->assertResult(5);
    }

    public function testIsFreeCount()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(CardGroup::class)->create([
            'id'      => 11,
            'user_id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id'         => 101,
            'match_id'   => 21,
            'group_id'   => 11,
            'chooser_id' => 1,
            'created_at' => (new \DateTime)->format('Y-m-d H:i:s')
        ]);
        $this->factory(Card::class)->create([
            'id'         => 102,
            'match_id'   => 22,
            'group_id'   => 11,
            'chooser_id' => 1,
            'created_at' => (new \DateTime)->format('Y-m-d H:i:s')
        ]);
        $this->factory(Card::class)->create([
            'id'         => 103,
            'match_id'   => 23,
            'group_id'   => 11,
            'chooser_id' => 1,
            'created_at' => (new \DateTime)->format('Y-m-d H:i:s')
        ]);

        $this->authUserId = 1;
        $this->cardId = 101;
        $this->type = Activity::TYPE_CARD_FLIP;
        $this->timezone = 'UTC';
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 1001,
            'related_id' => 101,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_FLIP
        ]);
        $this->cardId = 102;
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 1002,
            'related_id' => 102,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_FLIP
        ]);
        $this->cardId = 103;
        $this->assertResult(5);

        $this->cardId = 101;
        $this->type = Activity::TYPE_CARD_OPEN;
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 1003,
            'related_id' => 101,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_OPEN
        ]);
        $this->factory(Activity::class)->create([
            'id'         => 1004,
            'related_id' => 21,
            'user_id'    => 1,
            'type'       => Activity::TYPE_MATCH_OPEN
        ]);
        $this->cardId = 102;
        $this->assertResult(5);

        $this->factory(Activity::class)->create([
            'id'         => 1005,
            'related_id' => 102,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_OPEN
        ]);
        $this->factory(Activity::class)->create([
            'id'         => 1006,
            'related_id' => 22,
            'user_id'    => 1,
            'type'       => Activity::TYPE_MATCH_OPEN
        ]);
        $this->cardId = 101;
        $this->type = Activity::TYPE_CARD_PROPOSE;
        $this->assertResult(0);

        $this->factory(Activity::class)->create([
            'id'         => 1007,
            'related_id' => 101,
            'user_id'    => 1,
            'type'       => Activity::TYPE_CARD_PROPOSE
        ]);
        $this->factory(Activity::class)->create([
            'id'         => 1008,
            'related_id' => 21,
            'user_id'    => 1,
            'type'       => Activity::TYPE_MATCH_PROPOSE
        ]);
        $this->cardId = 102;
        $this->assertResult(5);
    }

}
