<?php

namespace Tests\Functional\Friends;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'friends';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('user_id', 2);

            $this->runService();

            $this->assertResultWithPersisting(new Friend([
                Friend::MATCH_ID => 11,
                Friend::SENDER_ID => 1,
                Friend::RECEIVER_ID => 2,
            ]));
        });

        $this->when(function () {
            Friend::factory()->create([
                'id' => 21,
                'match_id' => 11,
                'sender_id' => 2,
                'receiver_id' => 1,
            ]);

            $this->setAuthUser(User::find(1));
            $this->setInputParameter('user_id', 2);

            $this->runService();

            $this->assertResultWithPersisting(new Friend([
                Friend::MATCH_ID => 11,
                Friend::SENDER_ID => 1,
                Friend::RECEIVER_ID => 2,
            ]));
            $this->assertTrue((bool) ChattingContent::where([
                ChattingContent::MATCH_ID => 11,
                ChattingContent::WRITER_ID => null,
                ChattingContent::MESSAGE => '',
            ])->first());
        });
    }

    public function testErrorIntegerRuleUserId()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('user_id', 'abcd');

            $this->runService();

            $this->assertError('[user_id] must be an integer.');
        });
    }

    public function testErrorNotNullRuleMatch()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('user_id', 2);

            $this->runService();

            $this->assertError('match for user for [user_id] and authorized user must exist.');
        });
    }

    public function testErrorNotNullRuleUser()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('user_id', 2);

            $this->runService();

            $this->assertError('user for [user_id] must exist.');
        });
    }
}
