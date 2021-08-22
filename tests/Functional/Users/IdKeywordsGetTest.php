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
    protected $uri = 'users/{id}/keywords';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        UserKeyword::factory()->create(['id' => 11, 'user_id' => 1]);
        UserKeyword::factory()->create(['id' => 12, 'user_id' => 2]);
        UserKeyword::factory()->create(['id' => 13, 'user_id' => 2]);
        UserKeyword::factory()->create(['id' => 14, 'user_id' => 1]);

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
