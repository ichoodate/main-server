<?php

namespace App\Database\Queries;

use App\Database\Models\Popularity;
use App\Database\Models\User;
use App\Database\Query;

class PopularityQuery extends Query {

    public function receiverQuery()
    {
        $subQuery = $this->qSelect(Popularity::RECEIVER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function senderQuery()
    {
        $subQuery = $this->qSelect(Popularity::SENDER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
