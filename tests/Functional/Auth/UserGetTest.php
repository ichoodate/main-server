<?php

namespace Tests\Functional\Auth;

use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class UserGetTest extends _TestCase
{
    protected $uri = 'api/auth/user';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);

        $this->when(function () {
            $this->assertResult(null);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));

            $this->assertResult(User::find(2));
        });
    }
}
