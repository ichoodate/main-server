<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
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
            'available_expands' => function () {
                return ['match', 'match.user', 'match.user.facePhoto', 'writer'];
            },

            'match' => function ($authUser, $model) {
                return [MatchingFindingService::class, [
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],
        ];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
        ];
    }
}
