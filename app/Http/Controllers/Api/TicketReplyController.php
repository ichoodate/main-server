<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Reply\TicketReplyCreatingService;
use App\Services\Reply\TicketReplyPagingService;

class TicketReplyController extends ApiController {

    public static function index()
    {
        return [TicketReplyPagingService::class, [
            'auth_user'
                => auth()->user(),
            'ticket_id'
                => request()->route()->ticket,
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
            'auth_user'
                => 'authorized user',
            'ticket_id'
                => request()->route()->ticket,
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

    public static function store()
    {
        return [TicketReplyCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'description'
                => static::input('description'),
            'ticket_id'
                => request()->route()->ticket
        ], [
            'auth_user'
                => 'authorized user',
            'description'
                => '[description]',
            'ticket_id'
                => request()->route()->ticket
        ]];
    }

}
