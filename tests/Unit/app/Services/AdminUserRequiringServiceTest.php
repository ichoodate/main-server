<?php

namespace Tests\Unit\App\Services;

use App\Database\Models\Role;
use Tests\Unit\App\Services\_TestCase;
use Tests\Unit\App\Database\Queries\_Mocker as QueryMocker;

class AdminUserRequiringServiceTest extends _TestCase {

    public function testArrBindNames()
    {
        $this->verifyArrBindNames([
            'admin_role'
                => 'admin role for {{auth_user}}'
        ]);
    }

    public function testArrRuleLists()
    {
        $this->verifyArrRuleLists([
            'admin_role'
                => ['required']
        ]);
    }

    public function testLoaderAdminRole()
    {
        $this->when(function ($proxy, $serv) {

            $authUser  = $this->mMock();
            $roleQuery = $this->mMock();
            $return    = $this->uniqueString();

            $authUser->shouldReceive('roleQuery')->withNoArgs()->once()->andReturn($roleQuery);

            QueryMocker::qWhere($roleQuery, Role::TYPE, Role::TYPE_ADMIN);
            QueryMocker::first($roleQuery, $return);

            $proxy->data->put('auth_user', $authUser);

            $this->verifyLoader($serv, 'admin_role', $return);
        });
    }

}
