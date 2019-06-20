<?php

namespace App\Database\Queries;

use App\Database\Models\Payment;
use App\Database\Models\Item;
use App\Database\Models\User;
use App\Database\Query;

class PaymentQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Payment::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function itemQuery()
    {
        $subQuery = $this->qSelect(Payment::ITEM_ID)->getQuery();

        return inst(Item::class)->query()
            ->qWhereIn(Item::ID, $subQuery);
    }

}
