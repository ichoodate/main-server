<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Match\MatchFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class ChattingContentListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.match' => function ($match, $query) {
                $query->qWhere(ChattingContent::MATCH_ID, $match->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'token' => $authToken,
                ], [
                    'token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return ['match', 'writer'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [ChattingContentFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'match' => function ($authUser, $matchId) {
                return [MatchFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $matchId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{match_id}}',
                ]];
            },

            'model_class' => function () {
                return ChattingContent::class;
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'match_id' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
