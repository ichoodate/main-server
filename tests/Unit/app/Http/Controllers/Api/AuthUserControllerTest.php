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
        $authUser = $this->factory(User::class)->make();
        $email    = $this->uniqueString();
        $birth    = $this->uniqueString();
        $name     = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('email', $email);
        $this->setInputParameter('birth', $birth);
        $this->setInputParameter('name', $name);

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
