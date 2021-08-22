<?php

namespace Tests\Functional\Popularities;

use App\Models\Popularity;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'popularities/{id}';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        Popularity::factory()->create(['id' => 11, 'sender_id' => 1, 'receiver_id' => 2]);
        Popularity::factory()->create(['id' => 12, 'sender_id' => 3, 'receiver_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertResultWithFinding(11);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
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
        Popularity::factory()->create(['id' => 11]);
        Popularity::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->assertError('popularity for 13 must exist.');
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
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);
        Popularity::factory()->create(['id' => 11, 'sender_id' => 1, 'receiver_id' => 2]);
        Popularity::factory()->create(['id' => 12, 'sender_id' => 3, 'receiver_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(3));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of popularity for 11 is required.');
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 12);

            $this->assertError('authorized user who is related user of popularity for 12 is required.');
        });
    }
}
