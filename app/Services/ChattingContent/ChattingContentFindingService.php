<?php

namespace App\Services\ChattingContent;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use Illuminate\Extend\Service;
use App\Services\FindingService;
use App\Services\Match\MatchFindingService;

class ChattingContentFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'chatting_content for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['match', 'writer'];
            }],

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
        return [
            'auth_user'
                => ['required']
        ];
    }

    public static function getArrTraits()
    {
        return [
            FindingService::class
        ];
    }

}
