<?php

namespace App\Http\Controllers;

use App\Http\ControllersController;
use App\Services\UserSelfKwdPvt\UserKeywordListingService;

class SelfKeywordController extends ApiController
{
    public static function index()
    {
        return [UserKeywordListingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }
}
