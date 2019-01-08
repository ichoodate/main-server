<?php

namespace App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\Obj;
use App\Database\Models\User;
use App\Database\Query;

class ActivityQuery extends Query {

    public function relatedQuery()
    {
        $subQuery = $this->qSelect(Activity::RELATED_ID)->getQuery();

        return inst(Obj::class)->aliasQuery()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(Activity::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
