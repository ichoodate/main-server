<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Ticket\TicketCreatingService;
use App\Services\Ticket\TicketFindingService;
use App\Services\Ticket\TicketListingService;

class TicketController extends Controller
{
    public static function index()
    {
        return [TicketListingService::class];
    }

    public static function show()
    {
        return [TicketFindingService::class];
    }

    public static function store()
    {
        return [TicketCreatingService::class, [
            'subject' => static::input('subject'),
            'description' => static::input('description'),
        ], [
            'subject' => '[subject]',
            'description' => '[description]',
        ]];
    }
}
