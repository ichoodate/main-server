<?php

namespace App\Database\Queries;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;
use App\Database\Query;

class TicketQuery extends Query {

    public function replyQuery()
    {
        $subQuery = $this->qSelect(Ticket::ID)->getQuery();

        return inst(Reply::class)->query()
            ->qWhereIn(Reply::TICKET_ID, $subQuery);
    }

    public function writerQuery()
    {
        $subQuery = $this->qSelect(Ticket::WRITER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
