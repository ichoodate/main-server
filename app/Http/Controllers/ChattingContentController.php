<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Services\ChattingContent\ChattingContentCreatingService;
use App\Services\ChattingContent\ChattingContentFindingService;
use App\Services\ChattingContent\ChattingContentListingService;

class ChattingContentController extends Controller
{
    public static function index()
    {
        return [ChattingContentListingService::class, [
            'match_id' => static::input('match_id'),
            'type' => static::input('type'),
        ], [
            'match_id' => '[match_id]',
            'type' => '[type]',
        ]];
    }

    public static function show()
    {
        return [ChattingContentFindingService::class];
    }

    public static function store()
    {
        return [ChattingContentCreatingService::class, [
            'match_id' => static::input('match_id'),
            'message' => static::input('message'),
        ], [
            'match_id' => '[match_id]',
            'message' => '[message]',
        ]];
    }
}
