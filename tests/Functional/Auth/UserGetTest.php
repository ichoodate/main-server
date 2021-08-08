<?php

namespace Tests\Functional\Auth;

use App\Database\Models\User;
use Tests\Functional\_TestCase;

class UserGetTest extends _TestCase {

    protected $uri = 'api/auth/user';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(User::class)->create(['id' => 3]);

        $this->when(function () {

            $this->assertResult(null);
        });

        $this->when(function () {

            $this->setAuthUser(User::find(2));

            $this->assertResult(User::find(2));
        });
    }

}
