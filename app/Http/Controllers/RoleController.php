<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Role\RoleFindingService;
use App\Services\Role\RoleListingService;

class RoleController extends Controller
{
    public static function index()
    {
        return [RoleListingService::class];
    }

    public static function show()
    {
        return [RoleFindingService::class];
    }
}
