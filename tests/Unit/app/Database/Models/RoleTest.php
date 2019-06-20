<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Role;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class RoleTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Role::USER_ID,
            User::class
        );
    }

}
