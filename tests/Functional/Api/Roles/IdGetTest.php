<?php

namespace Tests\Functional\Api\Roles;

use App\Database\Models\User;
use App\Database\Models\Role;
use Tests\Functional\_TestCase;

class IdGetTest extends _TestCase {

    protected $uri = 'api/roles/{id}';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Role::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(Role::class)->create(['id' => 12, 'user_id' => 2]);

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
        $this->factory(Role::class)->create(['id' => 11]);
        $this->factory(Role::class)->create(['id' => 12]);

        $this->when(function () {

            $this->setRouteParameter('id', 13);

            $this->assertError('role for 13 must exist.');
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
        $this->factory(Role::class)->create(['id' => 11, 'user_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of role for 11 is required.');
        });
    }

}
