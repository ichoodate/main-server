<?php

namespace Tests\Functional\Matches;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdChattingContentsGetTest extends _TestCase
{
    protected $uri = 'api/matches/{id}/chatting-contents';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(User::class)->create(['id' => 3]);
        $this->factory(User::class)->create(['id' => 4]);
        $this->factory(Match::class)->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Match::class)->create(['id' => 12, 'man_id' => 3, 'woman_id' => 4]);
        $this->factory(ChattingContent::class)->create(['id' => 101, 'writer_id' => 1, 'match_id' => 11]);
        $this->factory(ChattingContent::class)->create(['id' => 102, 'writer_id' => 2, 'match_id' => 11]);
        $this->factory(ChattingContent::class)->create(['id' => 103, 'writer_id' => 3, 'match_id' => 12]);

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
        $this->factory(User::class)->create(['id' => 1]);

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
        $this->factory(User::class)->create(['id' => 3]);
        $this->factory(Match::class)->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(3));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of match for 11 is required.');
        });
    }
}
