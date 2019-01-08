<?php

namespace App\Services\ChattingContent;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Service;
use App\Services\Match\MatchFindingService;

class ChattingContentFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'chatting_content of {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'match' => ['auth_user', 'model', function ($authUser, $model) {

                return [MatchFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $model->{ChattingContent::MATCH_ID}
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => 'match_id of {{model}}'
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
        return [];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class,
            FindingService::class
        ];
    }

}
