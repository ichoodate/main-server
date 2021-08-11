<?php

namespace Tests\Functional\Auth;

use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class SignOutPostTest extends _TestCase
{
    protected $uri = 'api/auth/sign-out';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(User::class)->create(['id' => 3]);

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->assertEquals(auth()->user(), User::find(2));

            $this->assertResult(true);
            $this->assertEquals(auth()->user(), null);
        });
    }
}
