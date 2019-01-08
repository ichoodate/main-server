<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;

class ReplyTest extends _TestCase {

    public function testTicketQuery()
    {
        $this->assertBelongsToQuery(
            'question',
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
