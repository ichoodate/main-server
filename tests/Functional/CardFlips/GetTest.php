<?php

namespace Tests\Functional\CardFlips;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Matching;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'card-flips';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Card::factory()->create(['id' => 21, 'match_id' => 11, 'chooser_id' => 1, 'showner_id' => 2]);
        CardFlip::factory()->create(['id' => 31, 'card_id' => 21, 'user_id' => 1]);
        CardFlip::factory()->create(['id' => 32, 'card_id' => 21, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('related_user_id', 2);

            $this->runService();

            $this->assertResultWithListing([31, 32]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('related_user_id', 2);
            $this->setInputParameter('flipper_id', 1);

            $this->runService();

            $this->assertResultWithListing([31]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('related_user_id', 2);
            $this->setInputParameter('flipper_id', 2);

            $this->runService();

            $this->assertResultWithListing([32]);
        });
    }

    public function testErrorIntegerRuleFlipUserId()
    {
        $this->when(function () {
            $this->setInputParameter('flipper_id', 'abcd');

            $this->runService();

            $this->assertError('[flipper_id] must be an integer.');
        });
    }

    public function testErrorNotNullRuleFlipUser()
    {
        $this->when(function () {
            $this->setInputParameter('flipper_id', 1234);

            $this->runService();

            $this->assertError('user for [flipper_id] must exist.');
        });
    }
}
