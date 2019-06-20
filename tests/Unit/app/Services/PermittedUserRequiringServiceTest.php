<?php

namespace Tests\Unit\App\Services;

use Tests\Unit\App\Services\_TestCase;

class PermittedUserRequiringServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'permitted_user'
                => '{{auth_user}} who is related user of {{model}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'auth_user'
                => ['required'],

            'permitted_user'
                => ['required']
        ]);
    }

    public function testArrTraits()
    {
        $this->verifyArrTraits([]);
    }

    public function testLoaderPermittedUser()
    {
        $this->when(function ($proxy, $serv) {

            $this->assertException(function () use ($serv) {

                $this->resolveLoader($serv, 'permitted_user');
            });
        });
    }

}
