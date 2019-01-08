<?php

namespace App\Database\Queries;

use App\Database\Models\IdealTypable;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class IdealTypableQuery extends Query {

    public function objQuery()
    {
        $subQuery = $this->qSelect(IdealTypable::KEYWORD_ID)->getQuery();

        return inst(Obj::class)->aliasQuery()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(IdealTypable::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
