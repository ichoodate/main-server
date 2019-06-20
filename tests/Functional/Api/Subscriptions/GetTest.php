<?php

namespace Tests\Functional\Api\Subscriptions;

use App\Database\Models\User;
use App\Database\Models\Subscription;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/subscriptions';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Subscription::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(Subscription::class)->create(['id' => 12, 'user_id' => 2]);
        $this->factory(Subscription::class)->create(['id' => 13, 'user_id' => 2]);
        $this->factory(Subscription::class)->create(['id' => 14, 'user_id' => 1]);

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
