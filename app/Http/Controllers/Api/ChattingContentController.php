<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\ChattingContent\ChattingContentCreatingService;
use App\Services\ChattingContent\ChattingContentFindingService;
use App\Services\ChattingContent\ChattingContentListingService;

class ChattingContentController extends ApiController
{
    public static function index()
    {
        return [ChattingContentListingService::class, [
            'auth_user' => auth()->user(),
            'match_id' => static::input('match_id'),
            'cursor_id' => static::input('cursor_id'),
            'limit' => static::input('limit'),
            'page' => static::input('page'),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'group_by' => '',
            'order_by' => '',
        ], [
            'auth_user' => 'authorized user',
            'match_id' => '[match_id]',
            'cursor_id' => '[cursor_id]',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'limit' => '[limit]',
            'page' => '[page]',
            'group_by' => '[group_by]',
            'order_by' => '[order_by]',
        ]];
    }

    public static function show()
    {
        return [ChattingContentFindingService::class, [
            'auth_user' => auth()->user(),
            'expands' => static::input('expands'),
            'fields' => static::input('fields'),
            'id' => request()->route()->chatting_content,
        ], [
            'auth_user' => 'authorized user',
            'expands' => '[expands]',
            'fields' => '[fields]',
            'id' => request()->route()->chatting_content,
        ]];
    }

    public static function store()
    {
        return [ChattingContentCreatingService::class, [
            'auth_user' => auth()->user(),
            'match_id' => static::input('match_id'),
            'message' => static::input('message'),
        ], [
            'auth_user' => 'authorized user',
            'match_id' => '[match_id]',
            'message' => '[message]',
        ]];
    }
}
