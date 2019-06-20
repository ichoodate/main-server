<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class ReplyQueryTest extends _TestCase {

    public function testTicketQuery()
    {
        $this->assertBelongsToQuery(
            'ticket',
            Reply::TICKET_ID,
            Ticket::class
        );
    }

    public function testWriterQuery()
    {
        $this->assertBelongsToQuery(
            'writer',
            Reply::WRITER_ID,
            User::class
        );
    }

}
