<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Reply\TicketReplyCreatingService;
use App\Services\Reply\TicketReplyListingService;

class TicketReplyController extends Controller
{
    public static function index()
    {
        return [TicketReplyListingService::class, [
            'auth_user' => auth()->user(),
            'ticket_id' => request()->route()->ticket,
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'authorized user',
            'ticket_id' => request()->route()->ticket,
            'cursor_id' => '[cursor_id]',
            'limit' => '[limit]',
            'page' => '[page]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function store()
    {
        return [TicketReplyCreatingService::class, [
            'auth_user' => auth()->user(),
            'description' => static::input('description'),
            'ticket_id' => request()->route()->ticket,
        ], [
            'auth_user' => 'authorized user',
            'description' => '[description]',
            'ticket_id' => request()->route()->ticket,
        ]];
    }
}
