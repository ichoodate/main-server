<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;

class TicketQueryTest extends _TestCase {

    public function testReplyQuery()
    {
        $this->assertHasOneOrManyQuery(
            'reply',
            Reply::class,
            Reply::TICKET_ID
        );
    }

    public function testWriterQuery()
    {
        $this->assertBelongsToQuery(
            'writer',
            Ticket::WRITER_ID,
            User::class
        );
    }

}
