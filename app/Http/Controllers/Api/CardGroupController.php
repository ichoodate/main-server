<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\CardGroup\CardGroupFindingService;
use App\Services\CardGroup\CardGroupListingService;
use App\Services\CardGroup\TodayCardGroupCreatingService;

class CardGroupController extends ApiController {

    public static function index()
    {
        return [CardGroupListingService::class, [
            'after'
                => static::input('after'),
            'auth_user'
                => auth()->user(),
            'cursor_id'
                => static::input('cursor_id'),
            'limit'
                => static::input('limit'),
            'page'
                => static::input('page'),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'group_by'
                => '',
            'order_by'
                => '',
            'timezone'
                => static::input('timezone'),
        ], [
            'after'
                => '[after]',
            'auth_user'
                => 'authorized user',
            'cursor_id'
                => '[cursor_id]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]',
            'timezone'
                => '[timezone]',
        ]];
    }

    public static function show()
    {
        return [CardGroupFindingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->card_group
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->card_group
        ]];
    }

    public static function store()
    {
        return [TodayCardGroupCreatingService::class, [
            'auth_user'
                => auth()->user()
        ], [
            'auth_user'
                => 'authorized user'
        ]];
    }

}
