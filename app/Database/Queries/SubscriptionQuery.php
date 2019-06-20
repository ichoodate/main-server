<?php

namespace App\Database\Queries;

use App\Database\Models\Subscription;
use App\Database\Models\Payment;
use App\Database\Models\User;
use App\Database\Query;

class SubscriptionQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Subscription::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function paymentQuery()
    {
        $subQuery = $this->qSelect(Subscription::PAYMENT_ID)->getQuery();

        return inst(Payment::class)->query()
            ->qWhereIn(Payment::ID, $subQuery);
    }

}
