<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Friend\FriendCreatingService;
use App\Services\Friend\FriendFindingService;

class FriendController extends ApiController {

    public static function show()
    {
        return [FriendFindingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->friend
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->friend
        ]];
    }

    public static function store()
    {
        return [FriendCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'match_id'
                => static::input('match_id'),
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => '[match_id]',
        ]];
    }

}
