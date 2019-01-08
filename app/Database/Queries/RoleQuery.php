<?php

namespace App\Database\Queries;

use App\Database\Models\Role;
use App\Database\Models\RoleUser;
use App\Database\Query;

class RoleQuery extends Query {

    public function roleUserQuery()
    {
        $subQuery = $this->qSelect(Role::ID)->getQuery();

        return inst(RoleUser::class)->aliasQuery()
            ->qWhereIn(RoleUser::ROLE_ID, $subQuery);
    }

}
