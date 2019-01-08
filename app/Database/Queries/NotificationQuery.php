<?php

namespace App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\User;
use App\Database\Query;

class NotificationQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(Notification::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
