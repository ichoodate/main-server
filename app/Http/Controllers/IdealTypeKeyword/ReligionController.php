<?php

namespace App\Http\Controllers\IdealTypeKeyword;

use App\Http\Controller;
use App\Services\IdealTypeKeyword\IdealTypeReligionKeywordUpdatingService;

class ReligionController extends Controller
{
    public static function update()
    {
        return [IdealTypeReligionKeywordUpdatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
