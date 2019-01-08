<?php

namespace App\Database\Queries;

use App\Database\Models\Reply;
use App\Database\Models\Ticket;
use App\Database\Models\User;
use App\Database\Query;

class ReplyQuery extends Query {

    public function ticketQuery()
    {
        $subQuery = $this->qSelect(Reply::TICKET_ID)->getQuery();

        return inst(Ticket::class)->aliasQuery()
            ->qWhereIn(Ticket::ID, $subQuery);
    }

    public function writerQuery()
    {
        $subQuery = $this->qSelect(Reply::WRITER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
