<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Role;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class RoleQueryTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Role::USER_ID,
            User::class
        );
    }

}
