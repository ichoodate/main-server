<?php

namespace Tests\Functional\Tickets;

use App\Database\Models\Ticket;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdRepliesPostTest extends _TestCase
{
    protected $uri = 'api/tickets/{id}/replies';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(User::class)->create(['id' => 3]);
        $this->factory(Role::class)->create(['type' => Role::TYPE_ADMIN, 'user_id' => 1]);
        $this->factory(Ticket::class)->create(['id' => 11, 'writer_id' => 2]);
        $this->factory(Ticket::class)->create(['id' => 12, 'writer_id' => 3]);

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
