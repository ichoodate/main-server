<?php

namespace App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Http\Controllers\ApiController;
use App\Services\ProfilePhoto\ProfilePhotoPagingService;

class UserProfilePhotoController extends ApiController {

    public static function index()
    {
        return [ProfilePhotoPagingService::class, [
            'user_id'
                => request()->route()->user,
            'cursor_id'
                => static::input('cursor_id'),
            'limit'
                => static::input('limit'),
            'page'
                => static::input('page'),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'user_id'
                => request()->route()->user,
            'cursor_id'
                => '[cursor_id]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]];
    }

}
