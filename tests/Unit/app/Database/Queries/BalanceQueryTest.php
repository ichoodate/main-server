<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Balance;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class BalanceQueryTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Balance::USER_ID,
            User::class
        );
    }

}
