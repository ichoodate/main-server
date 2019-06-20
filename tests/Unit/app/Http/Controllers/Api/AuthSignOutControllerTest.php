<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Services\Auth\AuthSignOutService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class AuthSignOutControllerTest extends _TestCase {

    public function testStore()
    {
        $this->assertReturn([AuthSignOutService::class]);
    }

}
