<?php

namespace App\Http\Controllers;

use App\Http\ControllersController;
use App\Models\User;
use App\Services\UserSelfKwdPvt\UserSelfKwdPvtListingService;

class UserSelfKeywordController extends ApiController
{
    public static function index()
    {
        return [UserSelfKwdPvtListingService::class, [
            'auth_user' => User::find(request()->route()->user),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'user for '.request()->route()->user,
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }
}
