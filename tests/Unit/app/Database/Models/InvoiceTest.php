<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Invoice;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class InvoiceTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Invoice::USER_ID,
            User::class
        );
    }

}
