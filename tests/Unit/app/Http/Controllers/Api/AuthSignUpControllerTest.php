<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\Role;
use App\Database\Models\User;
use App\Services\Auth\AuthSignUpService;

class AuthSignUpControllerTest extends _TestCase {

    public function testStore()
    {
        $email    = $this->uniqueString();
        $password = $this->uniqueString();
        $gender   = $this->uniqueString();
        $birth    = $this->uniqueString();
        $name     = $this->uniqueString();

        $this->setInputParameter('email', $email);
        $this->setInputParameter('password', $password);
        $this->setInputParameter('gender', $gender);
        $this->setInputParameter('birth', $birth);
        $this->setInputParameter('name', $name);

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
