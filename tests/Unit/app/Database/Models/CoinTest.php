<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Balance;
use App\Database\Models\Coin;
use App\Database\Models\Obj;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class CoinTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Coin::USER_ID,
            User::class
        );
    }

    public function testBalanceQuery()
    {
        $this->assertBelongsToQuery(
            'balance',
            Coin::BALANCE_ID,
            Balance::class
        );
    }

    public function testRelatedQuery()
    {
        $this->assertBelongsToQuery(
            'related',
            Coin::RELATED_ID,
            Obj::class
        );
    }

}
