<?php

namespace App\Http\Controllers\Keyword;

use App\Http\ControllersController;
use App\Services\Keyword\StatureRange\MaxStatureRangeListingService;

class MaxStatureRangeController extends ApiController
{
    public static function index()
    {
        return [MaxStatureRangeListingService::class, [
            'min' => static::input('min'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
        ], [
            'min' => '[min]',
            'expands' => '[expands]',
            'fields' => '[fields]',
        ]];
    }
}
