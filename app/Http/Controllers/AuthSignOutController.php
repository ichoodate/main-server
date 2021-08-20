<?php

namespace App\Http\Controllers;

use App\Http\ControllersController;
use App\Services\Auth\AuthSignOutService;

class AuthSignOutController extends ApiController
{
    public static function store()
    {
        return [AuthSignOutService::class];
    }
}
