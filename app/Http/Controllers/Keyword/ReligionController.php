<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Religion\ReligionFindingService;
use App\Services\Keyword\Religion\ReligionListingService;

class ReligionController extends Controller
{
    public static function index()
    {
        return [ReligionListingService::class, [
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [ReligionFindingService::class, [
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
