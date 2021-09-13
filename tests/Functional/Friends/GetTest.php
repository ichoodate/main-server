<?php

namespace Tests\Functional\CardFlips;

use App\Models\Friend;
use App\Models\Match;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'friends';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Friend::factory()->create(['id' => 21, 'match_id' => 11, 'sender_id' => 1, 'receiver_id' => 2]);
        Friend::factory()->create(['id' => 22, 'match_id' => 11, 'sender_id' => 2, 'receiver_id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('related_user_id', 2);

            $this->runService();

            $this->assertResultWithListing([21, 22]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('related_user_id', 2);
            $this->setInputParameter('sender_id', 1);

            $this->runService();

            $this->assertResultWithListing([21]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('related_user_id', 2);
            $this->setInputParameter('sender_id', 2);

            $this->runService();

            $this->assertResultWithListing([22]);
        });
    }

    public function testErrorIntegerRuleSenderId()
    {
        $this->when(function () {
            $this->setInputParameter('sender_id', 'abcd');

            $this->runService();

            $this->assertError('[sender_id] must be an integer.');
        });
    }
}
