<?php

namespace Tests\Feature\App\Services\Activity;

use Tests\Feature\App\Services\_TestCase;
use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\User;

class CardActivityCreatingServiceTest extends _TestCase {

    public function setUpArgs()
    {
        return [[
            'auth_user'
                => User::find($this->authUserId),
            'card_id'
                => $this->cardId,
            'type'
                => $this->type,
            'timezone'
                => $this->timezone
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => '[card_id]',
            'type'
                => '[type]',
            'timezone'
                => '[timezone]'
        ]];
    }

    public function testCardId()
    {
        $this->factory(User::class)->create([
            'id' => 1
        ]);
        $this->factory(Card::class)->create([
            'id' => 11,
            'chooser_id' => 1
        ]);

        $this->authUserId = 1;
        $this->cardId = 11;
        $this->type = Activity::TYPE_CARD_FLIP;
        $this->timezone = 'Asia/Seoul';

        $this->assertResult(inst(Activity::class, [[
            'user_id'    => 1,
            'related_id' => 11,
            'type'       => Activity::TYPE_CARD_FLIP
        ]]));
    }

}
