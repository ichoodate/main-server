<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\User\UserFindingService;

class UserController extends ApiController {

    public static function show()
    {
        return [UserFindingService::class, [
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->user
        ], [
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->user
        ]];
    }

}
