<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Matching\MatchingFindingService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ChattingContentFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'chatting_content for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return ['match', 'match.user', 'match.user.facePhoto', 'writer'];
            },

            'match' => function ($authToken, $model) {
                return [MatchingFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $model->{ChattingContent::MATCH_ID},
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => 'id of match of {{model}}',
                    'model' => 'match of {{model}}',
                ]];
            },

            'model_class' => function () {
                return ChattingContent::class;
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'available_expands' => ['auth_user'],
        ];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
        ];
    }
}
