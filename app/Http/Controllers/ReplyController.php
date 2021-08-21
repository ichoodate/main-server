<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Reply\ReplyCreatingService;
use App\Services\Reply\ReplyFindingService;
use App\Services\Reply\ReplyListingService;

class ReplyController extends Controller
{
    public static function index()
    {
        return [ReplyListingService::class, [
            'ticket_id' => static::input('ticket_id'),
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'ticket_id' => '[ticket_id]',
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
        return [ReplyFindingService::class, [
            'id' => request()->route()->reply,
        ], [
            'id' => request()->route()->reply,
        ]];
    }

    public static function store()
    {
        return [ReplyCreatingService::class, [
            'description' => static::input('description'),
            'ticket_id' => static::input('ticket_id'),
        ], [
            'description' => '[description]',
            'ticket_id' => '[ticket_id]',
        ]];
    }
}
