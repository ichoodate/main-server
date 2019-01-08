<?php

namespace App\Database\Queries;

use App\Database\Models\Profilable;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class ProfilableQuery extends Query {

    public function objQuery()
    {
        $subQuery = $this->qSelect(Profilable::KEYWORD_ID)->getQuery();

        return inst(Obj::class)->aliasQuery()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(Profilable::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
