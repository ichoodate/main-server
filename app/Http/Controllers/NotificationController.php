<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Notification\NotificationFindingService;
use App\Services\Notification\NotificationListingService;

class NotificationController extends Controller
{
    public static function index()
    {
        return [NotificationListingService::class];
    }

    public static function show()
    {
        return [NotificationFindingService::class];
    }
}
