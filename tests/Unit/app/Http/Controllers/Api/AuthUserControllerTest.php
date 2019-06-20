<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Auth\AuthUserReturningService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class AuthUserControllerTest extends _TestCase {

    public function testIndex()
    {
        $this->assertReturn([AuthUserReturningService::class]);
    }

}
