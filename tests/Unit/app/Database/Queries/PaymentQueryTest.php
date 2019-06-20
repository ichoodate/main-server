<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Item;
use App\Database\Models\Payment;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class PaymentQueryTest extends _TestCase {

    public function testItemQuery()
    {
        $this->assertBelongsToQuery(
            'item',
            Payment::ITEM_ID,
            Item::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Payment::USER_ID,
            User::class
        );
    }

}
