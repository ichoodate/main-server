<?php

namespace App\Services\Friend;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class FriendCreatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'auth_user' => 'authorized user',

            'friend' => 'requested friend of {{auth_user}} for {{user}}',

            'match' => 'match for {{user}} and {{auth_user}}',

            'user' => 'user for {{user_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'result.chatting_content' => function ($result) {
                $friend = Friend::query()
                    ->where(Friend::SENDER_ID, $result->{Friend::RECEIVER_ID})
                    ->where(Friend::RECEIVER_ID, $result->{Friend::SENDER_ID})
                    ->first()
                ;

                $chattingContent = ChattingContent::query()
                    ->where(ChattingContent::MATCH_ID, $result->{Friend::MATCH_ID})
                    ->first()
                ;

                if (!empty($friend) && empty($chattingContent)) {
                    ChattingContent::create([
                        ChattingContent::WRITER_ID => null,
                        ChattingContent::MESSAGE => '',
                        ChattingContent::MATCH_ID => $friend->{Friend::MATCH_ID},
                    ]);
                }
            },
        ];
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

            'friend' => function ($authUser, $user) {
                return Friend::where(Friend::SENDER_ID, $authUser->getKey())
                    ->where(Friend::RECEIVER_ID, $user->getKey())
                    ->first()
                ;
            },

            'match' => function ($authUser, $user) {
                if (User::GENDER_MAN == $authUser->gender) {
                    return Matching::where(Matching::MAN_ID, $authUser->getKey())
                        ->where(Matching::WOMAN_ID, $user->getKey())
                        ->first()
                    ;
                }

                return Matching::where(Matching::WOMAN_ID, $authUser->getKey())
                    ->where(Matching::MAN_ID, $user->getKey())
                    ->first()
                    ;
            },

            'result' => function ($authUser, $match, $user) {
                return Friend::create([
                    Friend::SENDER_ID => $authUser->getKey(),
                    Friend::RECEIVER_ID => $user->getKey(),
                    Friend::MATCH_ID => $match->getKey(),
                ]);
            },

            'user' => function ($userId) {
                return User::find($userId);
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'result' => ['friend'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'friend' => ['null'],

            'match' => ['not_null'],

            'user' => ['not_null'],

            'user_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
