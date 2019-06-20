<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Services\PwdReset\PwdResetCreatingService;
use App\Services\PwdReset\PwdResetUpdatingService;
use Illuminate\Support\Facades\Hash;

class PwdResetControllerTest extends _TestCase {

    public function testUpdate()
    {
        $id          = $this->uniqueString();
        $newPassword = $this->uniqueString();

        $this->setRouteParameter('id', $id);
        $this->setInputParameter('new_password', $newPassword);

        $this->assertReturn([PwdResetUpdatingService::class, [
            'id'
                => $id,
            'new_password'
                => $newPassword,
            'token'
                => $token,
        ], [
            'id'
                => $id,
            'new_password'
                => '[new_password]',
            'token'
                => '[token]',
        ]]);
    }

    public function testStore()
    {
        $email = $this->uniqueString();

        $this->setInputParameter('email', $email);

        $this->assertReturn([PwdResetCreatingService::class, [
            'email'
                => $email
        ], [
            'email'
                => '[email]'
        ]]);
    }

}
