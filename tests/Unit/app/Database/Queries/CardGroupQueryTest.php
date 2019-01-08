<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\User;

class CardGroupQueryTest extends _TestCase {

    public function testCardQuery()
    {
        $this->assertHasOneOrManyQuery(
            'card',
            Card::class,
            Card::GROUP_ID
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            CardGroup::USER_ID,
            User::class
        );
    }

}
