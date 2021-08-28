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
    protected $uri = 'balances/{id}';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Balance::factory()->create(['id' => 11, 'user_id' => 1]);
        Balance::factory()->create(['id' => 12, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->runService();

            $this->assertResultWithFinding(11);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 12);

            $this->runService();

            $this->assertResultWithFinding(12);
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->runService();

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleModel()
    {
        Balance::factory()->create(['id' => 11]);
        Balance::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->runService();

            $this->assertError('balance for 13 must exist.');
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
        Balance::factory()->create(['id' => 11, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->runService();

            $this->assertError('authorized user who is related user of balance for 11 is required.');
        });
    }
}
