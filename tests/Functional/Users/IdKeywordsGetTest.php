<?php

namespace Tests\Functional\Users;

use App\Models\User;
use App\Models\UserKeyword;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdKeywordsGetTest extends _TestCase
{
    protected $uri = 'api/users/{id}/keywords';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(UserKeyword::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(UserKeyword::class)->create(['id' => 12, 'user_id' => 2]);
        $this->factory(UserKeyword::class)->create(['id' => 13, 'user_id' => 2]);
        $this->factory(UserKeyword::class)->create(['id' => 14, 'user_id' => 1]);

        $this->when(function () {
            $this->setRouteParameter('id', 1);

            $this->assertResultWithListing([11, 14]);
        });

        $this->when(function () {
            $this->setRouteParameter('id', 2);

            $this->assertResultWithListing([12, 13]);
        });
    }
}