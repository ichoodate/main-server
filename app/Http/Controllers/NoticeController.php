<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Notice\NoticeCreatingService;
use App\Services\Notice\NoticeFindingService;
use App\Services\Notice\NoticeListingService;

class NoticeController extends Controller
{
    public static function index()
    {
        return [NoticeListingService::class];
    }

    public static function show()
    {
        return [NoticeFindingService::class];
    }

    public static function store()
    {
        return [NoticeCreatingService::class, [
            'description' => static::input('description'),
            'subject' => static::input('subject'),
            'type' => static::input('type'),
        ], [
            'description' => '[description]',
            'subject' => '[subject]',
            'type' => '[type]',
        ]];
    }
}
