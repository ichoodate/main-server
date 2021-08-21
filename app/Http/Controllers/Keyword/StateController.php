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
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'country_id' => '[country_id]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [StateFindingService::class, [
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