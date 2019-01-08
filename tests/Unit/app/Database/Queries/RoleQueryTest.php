<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Role;
use App\Database\Models\RoleUser;

class RoleQueryTest extends _TestCase {

    public function testRoleUserQuery()
    {
        $this->assertHasOneOrManyQuery(
            'roleUser',
            RoleUser::class,
            RoleUser::ROLE_ID
        );
    }

}
