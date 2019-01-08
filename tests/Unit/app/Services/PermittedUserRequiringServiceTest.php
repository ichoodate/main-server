<?php

namespace Tests\Unit\App\Services;

use Tests\Unit\App\Services\_TestCase;

class PermittedUserRequiringServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'permitted_user'
                => 'permitted {{auth_user}} for {{model}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'permitted_user'
                => ['required']
        ]);
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
