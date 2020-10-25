<?php

namespace App\Services\ChattingContent;

use App\Database\Models\Friend;
use App\Database\Models\ChattingContent;
use Illuminate\Extend\Service;
use App\Services\CreatingService;
use App\Services\Match\MatchFindingService;

class ChattingContentCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'match'
                => 'match of {{match_id}}',

            'matching_user_friend'
                => '{{auth_user}} in friend list of matching-user for {{match_id}}',

            'auth_user_friend'
                => 'matching_user in friend list of {{auth_user}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user_friend' => ['auth_user', 'matching_user_id', function ($authUser, $matchingUserId) {

                return Friend::query()
                    ->where(Friend::SENDER_ID, $authUser->getKey())
                    ->where(Friend::RECEIVER_ID, $matchingUserId)
                    ->first();
            }],

            'created' => ['auth_user', 'match', 'message', function ($authUser, $match, $message) {

                return (new ChattingContent)->create([
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

            'matching_user_friend' => ['auth_user', 'matching_user_id', function ($authUser, $matchingUserId) {

                return Friend::query()
                    ->where(Friend::SENDER_ID, $matchingUserId)
                    ->where(Friend::RECEIVER_ID, $authUser->getKey())
                    ->first();
            }],

            'matching_user_id' => ['auth_user', 'match', function ($authUser, $match) {

                return $match->{Match::MAN_ID} == $authUser->getKey() ? $match->{Match::WOMAN_ID} : $match->{Match::MAN_ID};
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'created'
                => ['auth_user_friend', 'matching_user_friend']
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'auth_user'
                => ['required'],

            'auth_user_friend'
                => ['not_null'],

            'match'
                => ['not_null'],

            'match_id'
                => ['required', 'integer'],

            'matching_user_friend'
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
