<?php

namespace Tests\Functional\Api\Matches;

use App\Database\Models\Activity;
use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

class IdChattingContentsPostTest extends _TestCase {

    protected $uri = 'api/matches/{id}/chatting-contents';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(User::class)->create(['id' => 3]);
        $this->factory(Match::class)->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        $this->factory(Match::class)->create(['id' => 12, 'man_id' => 3, 'woman_id' => 2]);
        $this->factory(Activity::class)->create(['id' => 101, 'user_id' => 1, 'related_id' => 11, 'type' => Activity::TYPE_MATCH_PROPOSE]);
        $this->factory(Activity::class)->create(['id' => 102, 'user_id' => 3, 'related_id' => 12, 'type' => Activity::TYPE_MATCH_PROPOSE]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('message', 'message1');

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 1,
                'match_id'  => 11,
                'message'   => 'message1'
            ]));
        });

        $this->when(function () {

            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 11);
            $this->setInputParameter('message', 'message2');

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 2,
                'match_id'  => 11,
                'message'   => 'message2'
            ]));
        });

        $this->when(function () {

            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 12);
            $this->setInputParameter('message', 'message3');

            $this->assertResultWithPersisting(new ChattingContent([
                'writer_id' => 2,
                'match_id'  => 12,
                'message'   => 'message3'
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
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 12);

            $this->assertError('match for 12 must exist.');
        });
    }


    public function testErrorNotNullRuleMatchPropose()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Match::class)->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

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

    public function testErrorNotNullRuleMatchPermittedUser()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(User::class)->create(['id' => 3]);
        $this->factory(Match::class)->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(3));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of match for 11 is required.');
        });
    }

    public function testErrorRequiredRuleMessage()
    {
        $this->when(function () {

            $this->assertError('[message] is required.');
        });
    }

}
