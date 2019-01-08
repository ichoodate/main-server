<?php

namespace Tests\Feature\App\Services\Activity;

use App\Database\Models\Activity;
use App\Database\Models\User;
use Tests\Feature\App\Services\_TestCase;

class CardActivityListingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => User::find($this->authUserId),
            'card_id'
                => $this->cardId
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => '[card_id]',
            'fields'
                => '[fields]'
        ]];
    }

    public function testCardId()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id' => 11,
            'chooser_id' => 1,
            'activities' => [[
                'id' => 101,
                'user_id' => 1
            ], [
                'id' => 102,
                'user_id' => 2
            ]]
        ]);
        $this->factory(Card::class)->create([
            'id' => 12,
            'chooser_id' => 1,
            'activities' => [[
                'id' => 103,
                'user_id' => 1
            ]]
        ]);
        $this->factory(Card::class)->create([
            'id' => 13,
            'activities' => [[
                'id' => 104
            ]]
        ]);

        $this->authUserId = 1;
        $this->cardId = 11;
        $this->assertResult(Activity::find([101, 102]));

        $this->cardId = 12;
        $this->assertResult(Activity::find([103]));
    }

}
