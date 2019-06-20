<?php

namespace Tests\Functional\Api\Auth;

use App\Database\Models\User;
use Tests\Functional\_TestCase;

class SignOutPostTest extends _TestCase {

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
