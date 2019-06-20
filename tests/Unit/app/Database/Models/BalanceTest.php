<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Balance;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class BalanceTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Balance::USER_ID,
            User::class
        );
    }

}
