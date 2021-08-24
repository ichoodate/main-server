<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserResidenceKeywordUpdatingService;

class ResidenceController extends Controller
{
    public static function update()
    {
        return [UserResidenceKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
