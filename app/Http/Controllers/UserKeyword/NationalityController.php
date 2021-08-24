<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserNationalityKeywordUpdatingService;

class NationalityController extends Controller
{
    public static function update()
    {
        return [UserNationalityKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
