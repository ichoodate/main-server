<?php

namespace Tests\Functional\ChattingContents;

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
    protected $uri = 'chatting-contents';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Friend::factory()->create(['id' => 101, 'sender_id' => 1, 'match_id' => 11, 'receiver_id' => 2]);
        Friend::factory()->create(['id' => 102, 'sender_id' => 2, 'match_id' => 11, 'receiver_id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('match_id', 11);
            $this->setInputParameter('message', 'message1');

            $this->runService();

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 1,
                'match_id' => 11,
                'message' => 'message1',
            ]));
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setInputParameter('match_id', 11);
            $this->setInputParameter('message', 'message2');

            $this->runService();

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 2,
                'match_id' => 11,
                'message' => 'message2',
            ]));
        });
    }

    public function testErrorIntegerRuleMatchId()
    {
        $this->when(function () {
            $this->setInputParameter('match_id', 'abcd');

            $this->runService();

            $this->assertError('[match_id] must be an integer.');
        });
    }

    public function testErrorNotNullRuleMatch()
    {
        User::factory()->create(['id' => 1]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('match_id', 12);

            $this->runService();

            $this->assertError('match for [match_id] must exist.');
        });
    }

    public function testErrorNotNullRuleMatchPermittedUser()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(3));
            $this->setInputParameter('match_id', 11);

            $this->runService();

            $this->assertError('authorized user who is related user of match for [match_id] is required.');
        });
    }

    public function testErrorNotNullRuleMatchPropose()
    {
        User::factory()->create(['id' => 1]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('match_id', 11);

            $this->runService();

            $this->assertError('matching_user in friends of authorized user for match for [match_id] must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRuleMessage()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[message] is required.');
        });
    }
}
