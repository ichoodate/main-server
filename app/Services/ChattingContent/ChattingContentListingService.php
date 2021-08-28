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

    public static function getArrCallbacks()
    {
        return [
            'query.match' => function ($match, $query) {
                $query->where(ChattingContent::MATCH_ID, $match->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['match', 'writer'];
            },

            'cursor' => function ($authToken, $cursorId) {
                return [ChattingContentFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $cursorId,
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'match' => function ($authToken, $matchId) {
                return [MatchFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $matchId,
                ], [
                    'auth_token' => '{{auth_token}}',
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
