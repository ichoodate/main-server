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

    public static function getArrCallbackLists()
    {
        return [];
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

            'match' => function ($authUser, $model) {
                return [MatchFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $model->{ChattingContent::MATCH_ID},
                ], [
                    'auth_user' => '{{auth_user}}',
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
        return [];
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
