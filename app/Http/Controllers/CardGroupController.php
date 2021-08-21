<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\CardGroup\CardGroupFindingService;
use App\Services\CardGroup\CardGroupListingService;
use App\Services\CardGroup\TodayCardGroupCreatingService;

class CardGroupController extends Controller
{
    public static function index()
    {
        return [CardGroupListingService::class, [
            'after' => static::input('after'),
            'timezone' => static::input('timezone'),
        ], [
            'after' => '[after]',
            'timezone' => '[timezone]',
        ]];
    }

    public static function show()
    {
        return [CardGroupFindingService::class];
    }

    public static function store()
    {
        return [TodayCardGroupCreatingService::class];
    }
}
