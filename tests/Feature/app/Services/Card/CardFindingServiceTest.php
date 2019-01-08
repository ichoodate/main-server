<?php

namespace Tests\Feature\App\Services\Card;

use App\Database\Models\Card;
use App\Database\Models\User;
use Tests\Feature\App\Services\_TestCase;

class CardFindingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => User::find($this->authUserId),
            'id'
                => $this->cardId
        ], [
            'auth_user'
                => 'authorized user',
            'id'
                => '[id]'
        ]];
    }

    public function testResult()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id' => 11,
            'chooser_id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id' => 12,
            'showner_id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id' => 13
        ]);

        $this->authUserId = 1;
        $this->cardId = 11;
        $this->assertResult(Card::find(11));

        $this->cardId = 12;
        $this->assertResult(Card::find(12));

        $this->cardId = 13;
        $this->assertError('authorized user who is owner of card of [id] is required.');
    }

}
