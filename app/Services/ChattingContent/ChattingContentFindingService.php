<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Match\MatchFindingService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class ChattingContentFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'chatting_content for {{id}}',
        ];
    }

    public static function getArrCallbacks()
    {
        return [];
    }

    public static function getArrLoaders()
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
                return [MatchFindingService::class, [
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

    public static function getArrPromiseLists()
    {
        return [
            'available_expands' => ['auth_user'],
        ];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [
            FindService::class,
        ];
    }
}
