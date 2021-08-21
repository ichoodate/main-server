<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Residence\ResidenceFindingService;
use App\Services\Keyword\Residence\ResidenceListingService;

class ResidenceController extends Controller
{
    public static function index()
    {
        return [ResidenceListingService::class];
    }

    public static function show()
    {
        return [ResidenceFindingService::class];
    }
}
