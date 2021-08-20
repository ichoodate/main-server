<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\ProfilePhoto\ProfilePhotoListingService;

class UserProfilePhotoController extends Controller
{
    public static function index()
    {
        return [ProfilePhotoListingService::class, [
            'user_id' => request()->route()->user,
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'user_id' => request()->route()->user,
            'cursor_id' => '[cursor_id]',
            'limit' => '[limit]',
            'page' => '[page]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }
}
