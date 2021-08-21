<?php

namespace App\Http\Controllers\UserKeyword;

use App\Http\Controller;
use App\Services\UserKeyword\UserNationalityKeywordCreatingService;

class NationalityController extends Controller
{
    public static function store()
    {
        return [UserNationalityKeywordCreatingService::class, [
            'keyword_id' => static::input('keyword_id'),
        ], [
            'keyword_id' => '[keyword_id]',
        ]];
    }
}
