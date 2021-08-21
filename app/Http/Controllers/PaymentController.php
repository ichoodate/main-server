<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Payment\PaymentFindingService;
use App\Services\Payment\PaymentListingService;

class PaymentController extends Controller
{
    public static function index()
    {
        return [PaymentListingService::class];
    }

    public static function show()
    {
        return [PaymentFindingService::class];
    }
}
