<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;
use App\Services\ProfilePhoto\ProfilePhotoFindingService;
use App\Services\ProfilePhoto\ProfilePhotoListingService;

class ProfilePhotoController extends ApiController
{
    public static function index()
    {
        return [ProfilePhotoListingService::class, [
            'user' => auth()->user() ? auth()->user() : '',
            'user_id' => auth()->user() ? auth()->user()->getKey() : '',
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'user' => 'authorized user',
            'user_id' => 'id of authorized user',
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
        return [ProfilePhotoFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->profile_photo,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->profile_photo,
        ]];
    }

    public static function store()
    {
        return [ProfilePhotoCreatingService::class, [
            'auth_user' => auth()->user(),
            'data' => static::input('data'),
        ], [
            'auth_user' => 'authorized user',
            'data' => '[data]',
        ]];
    }
}
