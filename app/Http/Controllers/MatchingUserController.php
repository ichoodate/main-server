<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\User\MatchingUserFindingService;
use App\Services\User\MatchingUserListingService;

class MatchingUserController extends Controller
{
    public static function index()
    {
        return [MatchingUserListingService::class, [
            'keyword_ids' => static::input('keyword_ids'),
            'strict' => static::input('strict'),
        ], [
            'keyword_ids' => '[keyword_ids]',
            'strict' => '[strict]',
        ]];
    }

    public static function show()
    {
        return [MatchingUserFindingService::class];
    }
}
