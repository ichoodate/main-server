<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\CardFlip\CardFlipCreatingService;
use App\Services\CardFlip\CardFlipFindingService;
use App\Services\CardFlip\CardFlipListingService;

class CardFlipController extends Controller
{
    public static function index()
    {
        return [CardFlipListingService::class, [
            'flipper_id' => static::input('flipper_id'),
            'related_user_id' => static::input('related_user_id'),
        ], [
            'flipper_id' => '[flipper_id]',
            'related_user_id' => '[related_user_id]',
        ]];
    }

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
