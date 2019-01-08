<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Role;
use App\Database\Models\RoleUser;
use App\Database\Models\User;

class RoleUserTest extends _TestCase {

    public function testRoleQuery()
    {
        $this->assertBelongsToQuery(
            'role',
            RoleUser::ROLE_ID,
            Role::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            RoleUser::USER_ID,
            User::class
        );
    }

}
