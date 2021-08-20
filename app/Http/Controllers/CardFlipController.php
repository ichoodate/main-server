<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\CardFlip\CardFlipFindingService;
use App\Services\CardFlip\FreeCardFlipCreatingService;

class CardFlipController extends Controller
{
    public static function show()
    {
        return [CardFlipFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->card_flip,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->card_flip,
        ]];
    }

    public static function store()
    {
        return [FreeCardFlipCreatingService::class, [
            'auth_user' => auth()->user(),
            'card_id' => static::input('card_id'),
        ], [
            'auth_user' => 'authorized user',
            'card_id' => '[card_id]',
        ]];
    }
}
