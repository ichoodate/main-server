<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Friend\FriendCreatingService;
use App\Services\Friend\FriendFindingService;

class FriendController extends Controller
{
    public static function show()
    {
        return [FriendFindingService::class];
    }

    public static function store()
    {
        return [FriendCreatingService::class, [
            'match_id' => static::input('match_id'),
        ], [
            'match_id' => '[match_id]',
        ]];
    }
}
