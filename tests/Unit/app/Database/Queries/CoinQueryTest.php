<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Coin;
use App\Database\Models\Obj;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class CoinQueryTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Coin::USER_ID,
            User::class
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
