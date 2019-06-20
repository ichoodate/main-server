<?php

namespace App\Services\ChattingContent;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Service;
use App\Services\PagingService;
use App\Services\Match\MatchFindingService;

class MatchChattingContentPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.match' => ['query', 'match', function ($query, $match) {

                $query->qWhere(ChattingContent::MATCH_ID, $match->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [ChattingContentFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cursorId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'match' => ['auth_user', 'match_id', function ($authUser, $matchId) {

                return [MatchFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $matchId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{match_id}}'
                ]];
            }],

            'model_class' => [function () {

                return ChattingContent::class;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'match_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            PagingService::class
        ];
    }

}
