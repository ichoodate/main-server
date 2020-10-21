<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\Role;
use App\Database\Models\User;
use App\Services\Auth\AuthSignUpService;

class AuthSignUpControllerTest extends _TestCase {

    public function testStore()
    {
        $email    = $this->setInputParameter('email');
        $password = $this->setInputParameter('password');
        $gender   = $this->setInputParameter('gender');
        $birth    = $this->setInputParameter('birth');
        $name     = $this->setInputParameter('name');

        $this->assertReturn([AuthSignUpService::class, [
            'email'
                => $email,
            'password'
                => $password,
            'gender'
                => $gender,
            'birth'
                => $birth,
            'name'
                => $name
        ], [
            'email'
                => '[email]',
            'password'
                => '[password]',
            'gender'
                => '[gender]',
            'birth'
                => '[birth]',
            'name'
                => '[name]'
        ]]);
    }

}
