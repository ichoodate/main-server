<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Ticket;
use App\Database\Models\Reply;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class TicketTest extends _TestCase {

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
