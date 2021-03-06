<?php

namespace Tests\Functional\Replies;

use App\Models\Reply;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'replies';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        User::factory()->create(['id' => 4]);
        User::factory()->create(['id' => 5]);
        User::factory()->create(['id' => 6]);
        Role::factory()->create(['type' => 'admin', 'user_id' => 1]);
        Ticket::factory()->create(['id' => 11, 'writer_id' => 1]);
        Ticket::factory()->create(['id' => 12, 'writer_id' => 2]);
        Ticket::factory()->create(['id' => 13, 'writer_id' => 3]);
        Reply::factory()->create(['id' => 101, 'ticket_id' => 11]);
        Reply::factory()->create(['id' => 102, 'ticket_id' => 11]);
        Reply::factory()->create(['id' => 103, 'ticket_id' => 12]);
        Reply::factory()->create(['id' => 104, 'ticket_id' => 12]);
        Reply::factory()->create(['id' => 105, 'ticket_id' => 13]);
        Reply::factory()->create(['id' => 106, 'ticket_id' => 13]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('ticket_id', 11);

            $this->runService();

            $this->assertResultWithListing([101, 102]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('ticket_id', 12);

            $this->runService();

            $this->assertResultWithListing([103, 104]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setInputParameter('ticket_id', 12);

            $this->runService();

            $this->assertResultWithListing([103, 104]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(3));
            $this->setInputParameter('ticket_id', 13);

            $this->runService();

            $this->assertResultWithListing([105, 106]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 1234);

            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRulePermittedUser()
    {
        User::factory()->create(['id' => 1]);
        Ticket::factory()->create(['id' => 11, 'writer_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('ticket_id', 11);

            $this->runService();

            $this->assertError('authorized user who is related user of ticket for [ticket_id] is required.');
        });
    }

    public function testErrorRequiredRuleTicketId()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[ticket_id] is required.');
        });
    }
}
