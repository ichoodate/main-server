<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\CardFlip\CardFlipCreatingService;
use App\Services\CardFlip\CardFlipFindingService;

class CardFlipController extends ApiController {

    public static function show()
    {
        return [CardFlipFindingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->card_flip
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->card_flip
        ]];
    }

    public static function store()
    {
        return [CardFlipCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'card_id'
                => request()->route()->card,
            'timezone'
                => static::input('timezone')
        ], [
            'auth_user'
                => 'authorized user',
            'card_id'
                => request()->route()->card,
            'timezone'
                => '[timezone]'
        ]];
    }

}
