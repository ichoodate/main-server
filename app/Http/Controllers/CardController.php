<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Card\CardFindingService;
use App\Services\Card\CardListingService;

class CardController extends Controller
{
    public static function index()
    {
        return [CardListingService::class, [
            'after' => static::input('after'),
            'auth_user_status' => static::input('auth_user_status'),
            'before' => static::input('before'),
            'card_type' => static::input('card_type'),
            'match_status' => static::input('match_status'),
            'matching_user_status' => static::input('matching_user_status'),
            'timezone' => static::input('timezone'),
        ], [
            'after' => '[after]',
            'auth_user_status' => '[auth_user_status]',
            'before' => '[before]',
            'card_type' => '[card_type]',
            'match_status' => '[match_status]',
            'matching_user_status' => '[matching_user_status]',
            'timezone' => '[timezone]',
        ]];
    }

    public static function show()
    {
        return [CardFindingService::class];
    }
}
