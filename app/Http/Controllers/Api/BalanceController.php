<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Balance\BalanceFindingService;
use App\Services\Balance\BalanceListingService;

class BalanceController extends ApiController
{
    public static function index()
    {
        return [BalanceListingService::class, [
            'auth_user' => auth()->user(),
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'authorized user',
            'cursor_id' => '[cursor_id]',
            'limit' => '[limit]',
            'page' => '[page]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [BalanceFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->balance,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->balance,
        ]];
    }
}
