<?php

namespace Tests\Functional\Friends;

use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'friends';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 3, 'gender' => User::GENDER_WOMAN]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Matching::factory()->create(['id' => 12, 'man_id' => 1, 'woman_id' => 3]);
        Friend::factory()->create(['id' => 101, 'match_id' => 11, 'sender_id' => 1, 'receiver_id' => 2]);
        Friend::factory()->create(['id' => 102, 'match_id' => 11, 'sender_id' => 2, 'receiver_id' => 1]);
        Friend::factory()->create(['id' => 103, 'match_id' => 12, 'sender_id' => 1, 'receiver_id' => 3]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('sender_id', 1);

            $this->runService();

            $this->assertResultWithListing([101, 103]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('receiver_id', 1);

            $this->runService();

            $this->assertResultWithListing([102]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('sender_id', 2);
            $this->setInputParameter('receiver_id', 1);

            $this->runService();

            $this->assertResultWithListing([102]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('is_bidirectional', true);
            $this->setInputParameter('receiver_id', 1);

            $this->runService();
            $this->assertResultWithListing([102]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('is_bidirectional', true);
            $this->setInputParameter('sender_id', 1);

            $this->runService();

            $this->assertResultWithListing([101]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('is_bidirectional', false);
            $this->setInputParameter('sender_id', 1);

            $this->runService();

            $this->assertResultWithListing([103]);
        });
    }

    public function testErrorIntegerRuleReceiverId()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('receiver_id', 'abcd');

            $this->runService();

            $this->assertError('[receiver_id] must be an integer.');
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
