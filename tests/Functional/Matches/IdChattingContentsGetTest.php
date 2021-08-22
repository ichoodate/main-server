<?php

namespace Tests\Functional\Matches;

use App\Models\ChattingContent;
use App\Models\Match;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdChattingContentsGetTest extends _TestCase
{
    protected $uri = 'matches/{id}/chatting-contents';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        User::factory()->create(['id' => 4]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Match::factory()->create(['id' => 12, 'man_id' => 3, 'woman_id' => 4]);
        ChattingContent::factory()->create(['id' => 101, 'writer_id' => 1, 'match_id' => 11]);
        ChattingContent::factory()->create(['id' => 102, 'writer_id' => 2, 'match_id' => 11]);
        ChattingContent::factory()->create(['id' => 103, 'writer_id' => 3, 'match_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertResultWithListing([101, 102]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 11);

            $this->assertResultWithListing([101, 102]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(4));
            $this->setRouteParameter('id', 12);

            $this->assertResultWithListing([103]);
        });
    }

    public function testIntegerRuleMatchId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testNotNullRuleMatchModel()
    {
        User::factory()->create(['id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 1234);

            $this->assertError('match for 1234 must exist.');
        });
    }

    public function testRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }

    public function testRequiredRulePermittedUser()
    {
        User::factory()->create(['id' => 3]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(3));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of match for 11 is required.');
        });
    }
}
