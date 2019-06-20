<?php

namespace App\Database\Queries;

use App\Database\Models\Role;
use App\Database\Models\User;
use App\Database\Query;

class RoleQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Role::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
