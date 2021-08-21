<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\State\StateFindingService;
use App\Services\Keyword\State\StateListingService;

class StateController extends Controller
{
    public static function index()
    {
        return [StateListingService::class, [
            'country_id' => static::input('country_id'),
        ], [
            'country_id' => '[country_id]',
        ]];
    }

    public static function show()
    {
        return [StateFindingService::class];
    }
}
