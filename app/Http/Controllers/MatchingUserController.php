<?php

namespace App\Http\Controllers;

use App\Http\ControllersController;
use App\Services\User\MatchingUserFindingService;
use App\Services\User\MatchingUserListingService;

class MatchingUserController extends ApiController
{
    public static function index()
    {
        return [MatchingUserListingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'keyword_ids' => static::input('keyword_ids'),
            'limit' => static::input('limit'),
            'strict' => static::input('strict'),
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'keyword_ids' => '[keyword_ids]',
            'limit' => '[limit]',
            'strict' => '[strict]',
        ]];
    }

    public static function show()
    {
        return [MatchingUserFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->matching_user,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->matching_user,
        ]];
    }
}
