<?php

namespace Tests\Functional\Matches;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Match;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdChattingContentsPostTest extends _TestCase
{
    protected $uri = 'matches/{id}/chatting-contents';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Match::factory()->create(['id' => 12, 'man_id' => 3, 'woman_id' => 2]);
        Friend::factory()->create(['id' => 101, 'from_id' => 1, 'related_id' => 11, 'to_id' => 12]);
        Friend::factory()->create(['id' => 102, 'from_id' => 3, 'related_id' => 12, 'to_id' => 11]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('message', 'message1');

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 1,
                'match_id' => 11,
                'message' => 'message1',
            ]));
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('message', 'message2');

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 2,
                'match_id' => 11,
                'message' => 'message2',
            ]));
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 12);
            $this->setInputParameter('message', 'message3');

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 2,
                'match_id' => 12,
                'message' => 'message3',
            ]));
        });
    }

    public function testErrorIntegerRuleMatchId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleMatch()
    {
        User::factory()->create(['id' => 1]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 12);

            $this->assertError('match for 12 must exist.');
        });
    }

    public function testErrorNotNullRuleMatchPermittedUser()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(3));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of match for 11 is required.');
        });
    }

    public function testErrorNotNullRuleMatchPropose()
    {
        User::factory()->create(['id' => 1]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertError('match_propose for match of 11 must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRuleMessage()
    {
        $this->when(function () {
            $this->assertError('[message] is required.');
        });
    }
}
