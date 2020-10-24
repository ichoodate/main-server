<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\ChattingContent\ChattingContentFindingService;
use App\Services\ChattingContent\MatchChattingContentListingService;
use App\Services\ChattingContent\MatchChattingContentCreatingService;

class MatchChattingContentController extends ApiController {

    public static function index()
    {
        return [MatchChattingContentListingService::class, [
            'auth_user'
                => auth()->user(),
            'match_id'
                => request()->route()->match,
            'cursor_id'
                => static::input('cursor_id'),
            'limit'
                => static::input('limit'),
            'page'
                => static::input('page'),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => request()->route()->match,
            'cursor_id'
                => '[cursor_id]',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]];
    }

    public static function show()
    {
        return [ChattingContentFindingService::class, [
            'auth_user'
                => auth()->user(),
            'expands'
                => static::input('expands'),
            'fields'
                => static::input('fields'),
            'id'
                => request()->route()->chatting_content
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => request()->route()->chatting_content
        ]];
    }

    public static function store()
    {
        return [MatchChattingContentCreatingService::class, [
            'auth_user'
                => auth()->user(),
            'match_id'
                => request()->route()->match,
            'message'
                => static::input('message')
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => request()->route()->match,
            'message'
                => '[message]'
        ]];
    }

}
