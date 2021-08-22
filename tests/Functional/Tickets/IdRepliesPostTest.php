<?php

namespace Tests\Functional\Tickets;

use App\Models\Ticket;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdRepliesPostTest extends _TestCase
{
    protected $uri = 'tickets/{id}/replies';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        Role::factory()->create(['type' => Role::TYPE_ADMIN, 'user_id' => 1]);
        Ticket::factory()->create(['id' => 11, 'writer_id' => 2]);
        Ticket::factory()->create(['id' => 12, 'writer_id' => 3]);

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setInputParameter('ticket_id', 11);
            $this->setInputParameter('description', 'some content');

            $this->assertResultWithPersisting(new Reply([
                Reply::TICKET_ID => 11,
                Reply::WRITER_ID => 2,
                Reply::DESCRIPTION => 'some content',
            ]));
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('ticket_id', 11);
            $this->setInputParameter('description', 'some content');

            $this->assertResultWithPersisting(new Reply([
                Reply::TICKET_ID => 11,
                Reply::WRITER_ID => 1,
                Reply::DESCRIPTION => 'some content',
            ]));
        });
    }
}
