<?php

namespace App\Database\Queries;

use App\Database\Models\Coin;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class CoinQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Coin::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function relatedQuery()
    {
        $subQuery = $this->qSelect(Coin::RELATED_ID)->getQuery();

        return inst(Obj::class)->aliasQuery()
            ->qWhereIn(Obj::ID, $subQuery);
    }

}
