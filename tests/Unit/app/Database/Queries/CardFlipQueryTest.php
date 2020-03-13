<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class CardFlipQueryTest extends _TestCase {

    public function testCardQuery()
    {
        $this->assertBelongsToQuery(
            'card',
            CardFlip::CARD_ID,
            Card::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            CardFlip::USER_ID,
            User::class
        );
    }

}
