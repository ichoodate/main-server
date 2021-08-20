<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeKeywordListingService;

class IdealTypeKeywordController extends Controller
{
    public static function index()
    {
        return [IdealTypeKeywordListingService::class, [
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
