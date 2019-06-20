<?php

namespace App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Http\Controllers\ApiController;
use App\Services\UserSelfKwdPvt\UserSelfKwdPvtListingService;

class UserSelfKeywordController extends ApiController {

    public static function index()
    {
        return [UserSelfKwdPvtListingService::class, [
            'auth_user'
                => User::find(request()->route()->user),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'auth_user'
                => 'user for '.request()->route()->user,
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]];
    }

}
