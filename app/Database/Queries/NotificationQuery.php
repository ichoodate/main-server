<?php

namespace App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\User;
use App\Database\Query;

class NotificationQuery extends Query {

    public function activityQuery()
    {
        $subQuery = $this->qSelect(Notification::ACTIVITY_ID)->getQuery();

        return inst(Activity::class)->query()
            ->qWhereIn(Activity::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(Notification::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
