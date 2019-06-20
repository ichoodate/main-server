<?php

namespace Tests\Unit\App\Services\Auth;

use App\Database\Models\User;
use Tests\Unit\App\Services\_TestCase;

class AuthUserReturningServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderResult()
    {
        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();

            $this->verifyLoader($serv, 'result', null);
        });

        $this->when(function ($proxy, $serv) {

            $authUser = $this->factory(User::class)->make();

            auth()->setUser($authUser);

            $this->verifyLoader($serv, 'result', $authUser);
        });
    }

}
