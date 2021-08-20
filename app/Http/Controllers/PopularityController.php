<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Popularity\PopularityCreatingService;
use App\Services\Popularity\PopularityFindingService;
use App\Services\Popularity\PopularityListingService;

class PopularityController extends Controller
{
    public static function index()
    {
        return [PopularityListingService::class, [
            'auth_user' => auth()->user(),
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'authorized user',
            'cursor_id' => '[cursor_id]',
            'limit' => '[limit]',
            'page' => '[page]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [PopularityFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->popularity,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->popularity,
        ]];
    }

    public static function store()
    {
        return [PopularityCreatingService::class, [
            'auth_user' => auth()->user(),
            'user_id' => static::input('user_id'),
            'point' => static::input('point'),
        ], [
            'auth_user' => 'authorized user',
            'user_id' => '[user_id]',
            'point' => '[point]',
        ]];
    }
}
