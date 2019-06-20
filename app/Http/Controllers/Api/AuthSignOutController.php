<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Auth\AuthSignOutService;

class AuthSignOutController extends ApiController {

    public static function store()
    {
        return [AuthSignOutService::class];
    }

}
