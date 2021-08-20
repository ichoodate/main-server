<?php

namespace Tests\Functional\CardFlips;

use App\Models\Balance;
use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Match;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'api/card-flips';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Match::class)->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2, 'created_at' => '2000-01-01 11:22:33']);
        $this->factory(Balance::class)->create(['id' => 201, 'type' => Balance::TYPE_BASIC, 'count' => 10000, 'user_id' => 1, 'deleted_at' => '9999-12-31 23:59:59']);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_FLIP);
            $this->setRouteParameter('id', 11);

            $this->assertResultWithPersisting(new CardFlip([
                'user_id' => 1,
                'related_id' => 11,
                'type' => CardFlip::TYPE_CARD_FLIP,
            ]));
            $this->assertNotEquals(10000, Balance::find(201)->{Balance::COUNT});
        });

        $this->factory(CardFlip::class)->create(['id' => 1001, 'user_id' => 1, 'related_id' => 11, 'type' => CardFlip::TYPE_CARD_FLIP]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_OPEN);
            $this->setRouteParameter('id', 11);

            $this->assertResultWithPersisting(new CardFlip([
                'user_id' => 1,
                'related_id' => 11,
                'type' => CardFlip::TYPE_CARD_OPEN,
            ]));
            $this->assertPersistence(new CardFlip([
                'user_id' => 1,
                'related_id' => 101,
                'type' => CardFlip::TYPE_MATCH_OPEN,
            ]));
        });

        $this->factory(CardFlip::class)->create(['id' => 1002, 'user_id' => 1, 'related_id' => 101, 'type' => CardFlip::TYPE_MATCH_OPEN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_PROPOSE);
            $this->setRouteParameter('id', 11);

            $this->assertResultWithPersisting(new CardFlip([
                'user_id' => 1,
                'related_id' => 11,
                'type' => CardFlip::TYPE_CARD_PROPOSE,
            ]));
            $this->assertPersistence(new CardFlip([
                'user_id' => 1,
                'related_id' => 101,
                'type' => CardFlip::TYPE_MATCH_PROPOSE,
            ]));
        });
    }

    public function testErrorInRuleType()
    {
        $this->when(function () {
            $this->setInputParameter('type', 'aaaa');

            $this->assertError('[type] is invalid.');
        });
    }

    public function testErrorNotNullRuleCardFlip()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_OPEN);
            $this->setRouteParameter('id', 11);

            $this->assertError('flip status acted by authorized user for card for 11 must exist.');
        });
    }

    public function testErrorNotNullRuleMatchOpen()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_PROPOSE);
            $this->setRouteParameter('id', 11);

            $this->assertError('profile open status acted by matching users of card for 11 must exist.');
        });
    }

    public function testErrorNullRuleCardFlip()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2]);
        $this->factory(CardFlip::class)->create(['id' => 1001, 'user_id' => 1, 'related_id' => 11, 'type' => CardFlip::TYPE_CARD_FLIP]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_FLIP);
            $this->setRouteParameter('id', 11);

            $this->assertError('flip status acted by authorized user for card for 11 must not exist.');
        });
    }

    public function testErrorNullRuleMatchOpen()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2]);
        $this->factory(CardFlip::class)->create(['id' => 1001, 'user_id' => 1, 'related_id' => 101, 'type' => CardFlip::TYPE_MATCH_OPEN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_OPEN);
            $this->setRouteParameter('id', 11);

            $this->assertError('profile open status acted by matching users of card for 11 must not exist.');
        });
    }

    public function testErrorNullRuleMatchPropose()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2]);
        $this->factory(CardFlip::class)->create(['id' => 1001, 'user_id' => 1, 'related_id' => 101, 'type' => CardFlip::TYPE_MATCH_PROPOSE]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('type', CardFlip::TYPE_CARD_PROPOSE);
            $this->setRouteParameter('id', 11);

            $this->assertError('propose status acted by matching users of card for 11 must not exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRuleTimezone()
    {
        $this->when(function () {
            $this->assertError('[timezone] is required.');
        });
    }

    public function testErrorRequiredRuleType()
    {
        $this->when(function () {
            $this->assertError('[type] is required.');
        });
    }

    public function testErrorTimezoneRuleTimezone()
    {
        $this->when(function () {
            $this->setInputParameter('timezone', 'abcd');

            $this->assertError('[timezone] must be a valid zone.');
        });
    }
}
