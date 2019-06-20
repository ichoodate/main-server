<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Invoice;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class InvoiceQueryTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Invoice::USER_ID,
            User::class
        );
    }

}
