<?php

namespace App\Services\ChattingContent;

use App\Database\Models\Friend;
use App\Database\Models\ChattingContent;
use App\Service;
use App\Services\CreatingService;
use App\Services\Match\MatchFindingService;

class MatchChattingContentCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'match'
                => 'match of {{match_id}}',

            'match_propose'
                => 'match_propose for {{match}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['match', 'auth_user', 'message', function ($match, $authUser, $message) {

                return inst(ChattingContent::class)->create([
                    ChattingContent::WRITER_ID
                        => $authUser->getKey(),
                    ChattingContent::MESSAGE
                        => $message,
                    ChattingContent::MATCH_ID
                        => $match->getKey()
                ]);
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

            'match_propose' => ['auth_user', 'match', function ($authUser, $match) {

                return inst(Friend::class)->query()
                    ->qWhere(Friend::MATCH_ID, $match->getKey())
                    ->first();
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['match_propose']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'match'
                => ['not_null'],

            'match_id'
                => ['required', 'integer'],

            'match_propose'
                => ['not_null'],

            'message'
                => ['required', 'string']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
