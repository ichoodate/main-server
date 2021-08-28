<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\CardFlip\CardFlipCreatingService;
use App\Services\CardFlip\CardFlipFindingService;

class CardFlipController extends Controller
{
    public static function show()
    {
        return [CardFlipFindingService::class];
    }

    public static function store()
    {
        return [CardFlipCreatingService::class, [
            'card_id' => static::input('card_id'),
        ], [
            'card_id' => '[card_id]',
        ]];
    }
}
