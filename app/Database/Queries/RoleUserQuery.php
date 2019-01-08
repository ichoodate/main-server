<?php

namespace App\Database\Queries;

use App\Database\Models\Role;
use App\Database\Models\RoleUser;
use App\Database\Models\User;
use App\Database\Query;

class RoleUserQuery extends Query {

    public function roleQuery()
    {
        $subQuery = $this->qSelect(RoleUser::ROLE_ID)->getQuery();

        return inst(Role::class)->aliasQuery()
            ->qWhereIn(Role::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(RoleUser::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
