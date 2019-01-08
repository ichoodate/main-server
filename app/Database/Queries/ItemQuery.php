<?php

namespace App\Database\Queries;

use App\Database\Models\Item;
use App\Database\Models\Payment;
use App\Database\Models\User;
use App\Database\Query;

class ItemQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Item::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function paymentQuery()
    {
        $subQuery = $this->qSelect(Item::PAYMENT_ID)->getQuery();

        return inst(Payment::class)->aliasQuery()
            ->qWhereIn(Payment::ID, $subQuery);
    }

}
