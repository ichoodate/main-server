<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Friend\FriendCreatingService;

class FriendController extends ApiController {

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
