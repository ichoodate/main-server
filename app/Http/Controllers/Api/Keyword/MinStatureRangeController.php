<?php

namespace App\Http\Controllers\Api\Keyword;

use App\Http\Controllers\ApiController;
use App\Services\Keyword\StatureRange\MinStatureRangeListingService;

class MinStatureRangeController extends ApiController
{
    public static function index()
    {
        return [MinStatureRangeListingService::class, [
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
