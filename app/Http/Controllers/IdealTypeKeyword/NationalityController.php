<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeNationalityKeywordUpdatingService;

class NationalityController extends Controller
{
    public static function update()
    {
        return [IdealTypeNationalityKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
