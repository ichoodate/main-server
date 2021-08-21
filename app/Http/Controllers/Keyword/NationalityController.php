<?php

namespace App\Http\Controllers\Keyword;

use App\Http\Controller;
use App\Services\Keyword\Nationality\NationalityFindingService;

class NationalityController extends Controller
{
    public static function show()
    {
        return [NationalityFindingService::class];
    }
}
