<?php

namespace Tests\Functional\Auth;

use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class SignOutGetTest extends _TestCase
{
    protected $uri = 'auth/sign-out';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        User::factory()->create(['id' => 3]);

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->assertEquals(auth()->user(), User::find(2));

            $this->assertResult(true);
            $this->assertEquals(auth()->user(), null);
        });
    }
}
