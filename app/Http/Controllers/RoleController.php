<?php

namespace App\Http\Controllers;

use App\Http\ControllersController;
use App\Services\Role\RoleFindingService;
use App\Services\Role\RoleListingService;

class RoleController extends ApiController
{
    public static function index()
    {
        return [RoleListingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [RoleFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->role,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->role,
        ]];
    }
}
