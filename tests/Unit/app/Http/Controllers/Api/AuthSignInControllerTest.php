<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Services\Auth\AuthSignInService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class AuthSignInControllerTest extends _TestCase {

    public function testStore()
    {
        $email    = $this->setInputParameter('email');
        $password = $this->setInputParameter('password');

        $this->assertReturn([AuthSignInService::class, [
            'email'
                => $email,
            'password'
                => $password
        ], [
            'email'
                => '[email]',
            'password'
                => '[password]'
        ]]);
    }

}
