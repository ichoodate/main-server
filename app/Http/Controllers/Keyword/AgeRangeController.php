<?php

namespace App\Http\Controllers\Keyword;

use App\Http\ControllersController;
use App\Services\Keyword\AgeRange\AgeRangeFindingService;

class AgeRangeController extends ApiController
{
    public static function show()
    {
        return [AgeRangeFindingService::class, [
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->parameters()[array_keys(request()->route()->parameters())[0]],
        ], [
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->parameters()[array_keys(request()->route()->parameters())[0]],
        ]];
    }
}
