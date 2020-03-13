<?php

namespace App\Database\Queries;

use App\Database\Models\Friend;
use App\Database\Models\User;
use App\Database\Query;

class FriendQuery extends Query {

    public function senderQuery()
    {
        $subQuery = $this->qSelect(Friend::SENDER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function receiverQuery()
    {
        $subQuery = $this->qSelect(Friend::RECEIVER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
