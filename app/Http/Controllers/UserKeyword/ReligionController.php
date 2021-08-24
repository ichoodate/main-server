<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserReligionKeywordUpdatingService;

class ReligionController extends Controller
{
    public static function update()
    {
        return [UserReligionKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
