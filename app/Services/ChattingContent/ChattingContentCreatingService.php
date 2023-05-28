<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use App\Services\Matching\MatchingFindingService;
use FunctionalCoding\Service;

class ChattingContentCreatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'auth_user_friend' => 'matching_user in friends of {{auth_user}} for {{match}}',

            'match' => 'match for {{match_id}}',

            'matching_user_friend' => '{{auth_user}} in friends of matching_user for {{match}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'auth_user_friend' => function ($authUser, $matchingUserId) {
                return Friend::query()
                    ->where(Friend::SENDER_ID, $authUser->getKey())
                    ->where(Friend::RECEIVER_ID, $matchingUserId)
                    ->first()
                ;
            },

            'match' => function ($authUser, $matchId) {
                return [MatchingFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $matchId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{match_id}}',
                ]];
            },

            'matching_user_friend' => function ($authUser, $matchingUserId) {
                return Friend::query()
                    ->where(Friend::SENDER_ID, $matchingUserId)
                    ->where(Friend::RECEIVER_ID, $authUser->getKey())
                    ->first()
                ;
            },

            'matching_user_id' => function ($authUser, $match) {
                return $match->{Matching::MAN_ID} == $authUser->getKey() ? $match->{Matching::WOMAN_ID} : $match->{Matching::MAN_ID};
            },

            'result' => function ($authUser, $match, $matchingUserId, $message) {
                return (new ChattingContent())->create([
                    ChattingContent::SENDER_ID => $authUser->getKey(),
                    ChattingContent::RECEIVER_ID => $matchingUserId,
                    ChattingContent::MESSAGE => $message,
                    ChattingContent::MATCH_ID => $match->getKey(),
                ]);
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'result' => ['auth_user_friend', 'matching_user_friend'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'auth_user_friend' => ['not_null'],

            'match' => ['not_null'],

            'match_id' => ['required', 'integer'],

            'matching_user_friend' => ['not_null'],

            'message' => ['required', 'string'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
