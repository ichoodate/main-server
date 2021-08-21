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
        return [PopularityListingService::class];
    }

    public static function show()
    {
        return [PopularityFindingService::class];
    }

    public static function store()
    {
        return [PopularityCreatingService::class, [
            'user_id' => static::input('user_id'),
            'point' => static::input('point'),
        ], [
            'user_id' => '[user_id]',
            'point' => '[point]',
        ]];
    }
}
