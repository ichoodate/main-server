<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\User\UserFindingService;
use App\Services\Auth\AuthUserUpdatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class AuthUserControllerTest extends _TestCase {

    public function testIndex()
    {
        $this->assertReturn(null);

        $user    = $this->setAuthUser();
        $expands = $this->setInputParameter('expands');

        $this->assertReturn([UserFindingService::class, [
            'expands'
                => $expands,
            'id'
                => $user->getKey(),
        ], [
            'expands'
                => '[expands]',
            'id'
                => 'authorized user\'s ID',
        ]]);
    }

    public function testUpdate()
    {
        $authUser = $this->setAuthUser();
        $email    = $this->setInputParameter('email');
        $birth    = $this->setInputParameter('birth');
        $name     = $this->setInputParameter('name');

        $this->assertReturn([AuthUserUpdatingService::class, [
            'auth_user'
                => $authUser,
            'email'
                => $email,
            'birth'
                => $birth,
            'name'
                => $name,
        ],[
            'auth_user'
                => 'authorized user',
            'email'
                => '[email]',
            'birth'
                => '[birth]',
            'name'
                => '[name]',
        ]]);
    }

}
