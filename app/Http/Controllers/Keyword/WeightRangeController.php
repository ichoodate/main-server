<?php

namespace App\Http\Controllers\Keyword;

use App\Http\ControllersController;
use App\Services\Keyword\WeightRange\WeightRangeFindingService;

class WeightRangeController extends ApiController
{
    public static function show()
    {
        return [WeightRangeFindingService::class, [
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
