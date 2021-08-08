<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Ticket\TicketCreatingService;
use App\Services\Ticket\TicketFindingService;
use App\Services\Ticket\TicketListingService;

class TicketController extends ApiController
{
    public static function index()
    {
        return [TicketListingService::class, [
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
        return [TicketFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->ticket,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->ticket,
        ]];
    }

    public static function store()
    {
        return [TicketCreatingService::class, [
            'auth_user' => auth()->user(),
            'subject' => static::input('subject'),
            'description' => static::input('description'),
        ], [
            'auth_user' => 'authorized user',
            'subject' => '[subject]',
            'description' => '[description]',
        ]];
    }
}
