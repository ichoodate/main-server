<?php

namespace App\Database\Queries;

use App\Database\Models\Invoice;
use App\Database\Models\User;
use App\Database\Query;

class InvoiceQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Invoice::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
