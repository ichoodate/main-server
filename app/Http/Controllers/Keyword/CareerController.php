<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Career\CareerFindingService;
use App\Services\Keyword\Career\CareerListingService;

class CareerController extends Controller
{
    public static function index()
    {
        return [CareerListingService::class, [
            'parent_id' => static::input('parent_id'),
        ], [
            'parent_id' => '[parent_id]',
        ]];
    }

    public static function show()
    {
        return [CareerFindingService::class];
    }
}
