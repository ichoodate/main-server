<?php

namespace Tests\Functional\Api\Tickets;

use App\Database\Models\User;
use App\Database\Models\Ticket;
use Tests\Functional\_TestCase;

class IdGetTest extends _TestCase {

    protected $uri = 'api/tickets/{id}';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Ticket::class)->create(['id' => 11, 'writer_id' => 1]);
        $this->factory(Ticket::class)->create(['id' => 12, 'writer_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertResultWithFinding(11);
        });

        $this->when(function () {

            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 12);

            $this->assertResultWithFinding(12);
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {

            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleModel()
    {
        $this->factory(Ticket::class)->create(['id' => 11]);
        $this->factory(Ticket::class)->create(['id' => 12]);

        $this->when(function () {

            $this->setRouteParameter('id', 13);

            $this->assertError('ticket for 13 must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {

            $this->assertError('authorized user is required.');
        });
    }

    public function testRequiredRulePermittedUser()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Ticket::class)->create(['id' => 11, 'writer_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of ticket for 11 is required.');
        });
    }

}
