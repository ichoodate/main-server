<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Auth\AuthSignOutService;

class AuthSignOutController extends Controller
{
    public static function index()
    {
        return [AuthSignOutService::class];
    }
}
