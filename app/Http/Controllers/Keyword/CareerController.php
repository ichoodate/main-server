<?php

namespace App\Http\Controllers\Keyword;

use App\Http\ControllersController;
use App\Services\Keyword\Career\CareerFindingService;
use App\Services\Keyword\Career\CareerListingService;

class CareerController extends ApiController
{
    public static function index()
    {
        return [CareerListingService::class, [
            'parent_id' => static::input('parent_id'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'parent_id' => '[parent_id]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [CareerFindingService::class, [
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
