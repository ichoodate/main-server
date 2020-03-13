<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\Notification;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class CardFlipTest extends _TestCase {

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
