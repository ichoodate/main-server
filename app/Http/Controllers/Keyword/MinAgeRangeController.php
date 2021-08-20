<?php

namespace App\Http\Controllers\Keyword;

use App\Http\ControllersController;
use App\Services\Keyword\AgeRange\MinAgeRangeListingService;

class MinAgeRangeController extends ApiController
{
    public static function index()
    {
        return [MinAgeRangeListingService::class, [
            'max' => static::input('max'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
        ], [
            'max' => '[max]',
            'expands' => '[expands]',
            'fields' => '[fields]',
        ]];
    }
}
