<?php

namespace Tests\Functional\Api\Popularities;

use App\Database\Models\User;
use App\Database\Models\Popularity;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/popularities';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Popularity::class)->create(['id' => 11, 'receiver_id' => 1]);
        $this->factory(Popularity::class)->create(['id' => 12, 'receiver_id' => 2]);
        $this->factory(Popularity::class)->create(['id' => 13, 'receiver_id' => 2]);
        $this->factory(Popularity::class)->create(['id' => 14, 'receiver_id' => 1]);

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
