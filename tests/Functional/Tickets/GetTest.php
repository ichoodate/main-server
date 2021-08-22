<?php

namespace Tests\Functional\Tickets;

use App\Models\Ticket;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/tickets';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Ticket::factory()->create(['id' => 11, 'writer_id' => 1]);
        Ticket::factory()->create(['id' => 12, 'writer_id' => 2]);
        Ticket::factory()->create(['id' => 13, 'writer_id' => 2]);
        Ticket::factory()->create(['id' => 14, 'writer_id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));

            $this->assertResultWithListing([11, 14]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));

            $this->assertResultWithListing([12, 13]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }
}
