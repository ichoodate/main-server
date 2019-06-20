<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Card\CardFindingService;
use App\Services\Card\CardPagingService;

class CardController extends ApiController {

    public static function index()
    {
        return [CardPagingService::class, [
            'auth_user'
                => auth()->user(),
            'auth_user_status'
                => static::input('auth_user_status'),
            'card_type'
                => static::input('card_type'),
            'match_status'
                => static::input('match_status'),
            'matching_user_status'
                => static::input('matching_user_status'),
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
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'auth_user'
                => 'authorized user',
            'auth_user_status'
                => '[auth_user_status]',
            'card_type'
                => '[card_type]',
            'match_status'
                => '[match_status]',
            'matching_user_status'
                => '[matching_user_status]',
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
                => '[order_by]'
        ]];
    }

    public static function show()
    {
        return [CardFindingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->card
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->card
        ]];
    }

}
