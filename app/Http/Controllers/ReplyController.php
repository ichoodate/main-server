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
        ], [
            'ticket_id' => '[ticket_id]',
        ]];
    }

    public static function show()
    {
        return [ReplyFindingService::class];
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
