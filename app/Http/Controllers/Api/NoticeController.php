<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Notice\NoticeCreatingService;
use App\Services\Notice\NoticeFindingService;
use App\Services\Notice\NoticePagingService;

class NoticeController extends ApiController {

    public static function index()
    {
        return [NoticePagingService::class, [
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
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
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

    public static function show()
    {
        return [NoticeFindingService::class, [
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->notice
        ], [
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->notice
        ]];
    }

    public static function store()
    {
        return [NoticeCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'description'
                => static::input('description'),
            'subject'
                => static::input('subject'),
            'type'
                => static::input('type'),
        ], [
            'auth_user'
                => 'authorized user',
            'description'
                => '[description]',
            'subject'
                => '[subject]',
            'type'
                => '[type]'
        ]];
    }

}
