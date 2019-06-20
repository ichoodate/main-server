<?php

namespace App\Database\Queries;

use App\Database\Models\Balance;
use App\Database\Models\User;
use App\Database\Query;

class BalanceQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Balance::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
