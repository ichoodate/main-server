<?php

namespace Tests\Functional\Payments;

use App\Database\Models\Payment;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/payments/{id}';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Payment::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(Payment::class)->create(['id' => 12, 'user_id' => 2]);

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
        $this->factory(Payment::class)->create(['id' => 11]);
        $this->factory(Payment::class)->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->assertError('payment for 13 must exist.');
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
        $this->factory(Payment::class)->create(['id' => 11, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of payment for 11 is required.');
        });
    }
}