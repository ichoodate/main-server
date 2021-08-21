<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Balance\BalanceFindingService;
use App\Services\Balance\BalanceListingService;

class BalanceController extends Controller
{
    public static function index()
    {
        return [BalanceListingService::class];
    }

    public static function show()
    {
        return [BalanceFindingService::class];
    }
}
