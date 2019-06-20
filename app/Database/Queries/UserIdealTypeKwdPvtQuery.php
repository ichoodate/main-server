<?php

namespace App\Database\Queries;

use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class UserIdealTypeKwdPvtQuery extends Query {

    public function keywordQuery()
    {
        $subQuery = $this->qSelect(UserIdealTypeKwdPvt::KEYWORD_ID)->getQuery();

        return inst(Obj::class)->query()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(UserIdealTypeKwdPvt::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
