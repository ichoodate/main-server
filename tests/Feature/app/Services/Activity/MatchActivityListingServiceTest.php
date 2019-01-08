<?php

namespace Tests\Feature\App\Services\Activity;

use Tests\Feature\App\Services\_TestCase;

class MatchActivityListingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => User::find($this->authUserId),
            'match_id'
                => $this->matchId
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => '[match_id]',
            'fields'
                => '[fields]'
        ]];
    }

    public function testMatchId()
    {
        $this->factory(User::class)->create([
            'id' => 1,
            'gender' => User::GENDER_MAN
        ]);
        $this->factory(Match::class)->create([
            'id' => 11,
            'man_id' => 1,
            'woman_id' => 2,
            'activities' => [[
                'id' => 101,
                'user_id' => 1,
                'type' => Activity::TYPE_MATCH_OPEN
            ], [
                'id' => 102,
                'user_id' => 1,
                'type' => Activity::TYPE_MATCH_PROPOSE
            ], [
                'id' => 103,
                'user_id' => 2,
                'type' => Activity::TYPE_MATCH_PROPOSE
            ]]
        ]);
        $this->factory(Match::class)->create([
            'id' => 12,
            'man_id' => 1,
            'woman_id' => 3,
            'activities' => [[
                'id' => 104,
                'user_id' => 1
            ], [
                'id' => 105,
                'user_id' => 3
            ]]
        ]);

        $this->authUserId = 1;
        $this->matchId = 11;
        $this->assertResult(Activity::find([101, 102, 103]));

        $this->matchId = 12;
        $this->assertResult(Activity::find([104, 105]));
    }
}
