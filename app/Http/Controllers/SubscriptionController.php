<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Subscription\SubscriptionFindingService;
use App\Services\Subscription\SubscriptionListingService;

class SubscriptionController extends Controller
{
    public static function index()
    {
        return [SubscriptionListingService::class];
    }

    public static function show()
    {
        return [SubscriptionFindingService::class];
    }
}
