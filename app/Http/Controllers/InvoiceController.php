<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\Invoice\InvoiceFindingService;
use App\Services\Invoice\InvoiceListingService;

class InvoiceController extends Controller
{
    public static function index()
    {
        return [InvoiceListingService::class];
    }

    public static function show()
    {
        return [InvoiceFindingService::class];
    }
}
