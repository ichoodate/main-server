<?php

namespace App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\User;
use App\Database\Query;

class CardGroupQuery extends Query {

    public function cardQuery()
    {
        $subQuery = $this->qSelect(CardGroup::ID)->getQuery();

        return inst(Card::class)->aliasQuery()
            ->qWhereIn(Card::GROUP_ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(CardGroup::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
