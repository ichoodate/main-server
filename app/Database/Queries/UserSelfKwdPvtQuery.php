<?php

namespace App\Database\Queries;

use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class UserSelfKwdPvtQuery extends Query {

    public function keywordQuery()
    {
        $subQuery = $this->qSelect(UserSelfKwdPvt::KEYWORD_ID)->getQuery();

        return inst(Obj::class)->query()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(UserSelfKwdPvt::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
