<?php

namespace Tests\Functional\Balances;

use App\Models\Balance;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/balances/{id}';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Balance::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(Balance::class)->create(['id' => 12, 'user_id' => 2]);

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
        $this->factory(Balance::class)->create(['id' => 11]);
        $this->factory(Balance::class)->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->assertError('balance for 13 must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->setRouteParameter('id', $this->uniqueString());

            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRulePermittedUser()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(Balance::class)->create(['id' => 11, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of balance for 11 is required.');
        });
    }
}
