<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Role;
use App\Database\Models\RoleUser;

class RoleTest extends _TestCase {

    public function testRoleUserQuery()
    {
        $this->assertHasOneOrManyQuery(
            'roleUser',
            RoleUser::class,
            RoleUser::ROLE_ID
        );
    }

}
