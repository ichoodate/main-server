<?php

namespace Tests\Feature\App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Feature\App\Services\_TestCase;

class CardGroupCardListingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => User::find($this->authUserId),
            'card_group_id'
                => $this->cardGroupId
        ], [
            'auth_user'
                => 'authorized user',
            'card_group_id'
                => '[card_group_id]',
            'fields'
                => '[fields]'
        ]];
    }

    public function testCardGroupId()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(User::class)->create([
            'id' => 2
        ]);
        $this->factory(CardGroup::class)->create([
            'id' => 11,
            'user_id' => 1,
            'cards' => [[
                'id' => 101
            ],[
                'id' => 102
            ]]
        ]);
        $this->factory(CardGroup::class)->create([
            'id' => 12,
            'user_id' => 1,
            'cards' => [[
                'id' => 103
            ]]
        ]);
        $this->factory(CardGroup::class)->create([
            'id' => 13,
            'user_id' => 2,
            'cards' => [[
                'id' => 104
            ]]
        ]);

        $this->authUserId = 1;
        $this->cardGroupId = 11;
        $this->assertResult(Card::find([101, 102]));

        $this->cardGroupId = 12;
        $this->assertResult(Card::find([103]));
    }

}
