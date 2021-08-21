<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserResidenceKeywordCreatingService;

class ResidenceController extends Controller
{
    public static function store()
    {
        return [UserResidenceKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
