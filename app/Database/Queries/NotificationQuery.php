<?php

namespace App\Database\Queries;

use App\Database\Models\Notification;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class NotificationQuery extends Query {

    public function relatedQuery()
    {
        $subQuery = $this->qSelect(Notification::RELATED_ID)->getQuery();

        return inst(Obj::class)->query()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(Notification::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
