<?php

namespace Tests\Functional\CardFlips;

use App\Models\Balance;
use App\Models\Card;
use App\Models\CardFlip;
use App\Models\CardGroup;
use App\Models\Matching;
use App\Models\RequiredItem;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'card-flips';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Card::factory()->create(['id' => 11, 'match_id' => 101, 'chooser_id' => 1, 'showner_id' => 2, 'created_at' => (new \DateTime())->format('Y-m-d H:i:s')]);
        Matching::factory()->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        Balance::factory()->create(['id' => 201, 'type' => 'basic', 'count' => 10000, 'user_id' => 1, 'deleted_at' => null]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('timezone', 'Asia/Seoul');
            $this->setInputParameter('card_id', 11);

            $this->runService();

            $this->assertResultWithPersisting(new CardFlip([
                'user_id' => 1,
                'card_id' => 11,
            ]));
            $this->assertEquals(10000, Balance::find(201)->{Balance::COUNT});
        });
    }

    public function testErrorCard()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        Card::factory()->create(['id' => 11]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('card_id', 12);

            $this->runService();

            $this->assertError('card for [card_id] must exist.');
        });
    }

    public function testErrorFreeFlippableCard1()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 3, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 4, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 5, 'gender' => User::GENDER_WOMAN]);
        CardGroup::factory()->create(['id' => 10]);
        Card::factory()->create(['id' => 11, 'group_id' => 10, 'chooser_id' => 1, 'showner_id' => 2]);
        Card::factory()->create(['id' => 12, 'group_id' => 10, 'chooser_id' => 1, 'showner_id' => 3]);
        Card::factory()->create(['id' => 13, 'group_id' => 10, 'chooser_id' => 1, 'showner_id' => 4]);
        Card::factory()->create(['id' => 14, 'group_id' => 10, 'chooser_id' => 1, 'showner_id' => 5]);
        CardFlip::factory()->create(['user_id' => 1, 'card_id' => 11]);
        CardFlip::factory()->create(['user_id' => 1, 'card_id' => 12]);
        CardFlip::factory()->create(['user_id' => 1, 'card_id' => 13]);
        RequiredItem::factory()->create([
            'when' => 'card_flip',
            'type' => 'coin',
            'count' => 5,
        ]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('card_id', 14);

            $this->runService();

            $this->assertError('free flippable card for [card_id] must exist.');
        });
    }

    public function testErrorFreeFlippableCard2()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 3, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 4, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 5, 'gender' => User::GENDER_WOMAN]);
        CardGroup::factory()->create(['id' => 10]);
        Card::factory()->create(['id' => 11, 'group_id' => 10, 'chooser_id' => 1, 'showner_id' => 2, 'created_at' => '2000-01-01 00:00:00']);
        RequiredItem::factory()->create([
            'when' => 'card_flip',
            'type' => 'coin',
            'count' => 5,
        ]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('card_id', 11);

            $this->runService();

            $this->assertError('free flippable card for [card_id] must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }
}
