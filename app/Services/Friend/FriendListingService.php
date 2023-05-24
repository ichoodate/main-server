<?php

namespace App\Services\Friend;

use App\Models\Friend;
use App\Services\User\MatchingUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;
use Illuminate\Support\Facades\DB;

class FriendListingService extends Service
{
    public static function getBindNames()
    {
        return [
            'user_ids' => '{{sender_id}} and {{receiver_id}}',

            'nullable_receiver_id' => '{{receiver_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [
            'query.sender' => function ($query, $sender) {
                $query->where(Friend::SENDER_ID, $sender->getKey());
            },

            'query.receiver' => function ($query, $receiver) {
                $query->where(Friend::RECEIVER_ID, $receiver->getKey());
            },

            'query.is_bidirectional' => function ($query, $isBidirectional) {
                $query->joinSub(
                    Friend::query()->select([Friend::MATCH_ID]),
                    '_friends',
                    function ($join) use ($query) {
                        $join->on(
                            $query->from.'.'.Friend::MATCH_ID,
                            '=',
                            '_friends.'.Friend::MATCH_ID,
                        );
                    },
                );
                $query->groupByRaw('_friends.'.Friend::MATCH_ID);
                $query->having(
                    DB::raw('count(_friends.'.Friend::MATCH_ID.')'),
                    '=',
                    $isBidirectional ? 2 : 1,
                );
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['sender', 'receiver'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [FriendFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'nullable_receiver_id' => function ($receiverId = '') {
                return '' == $receiverId ? null : $receiverId;
            },

            'model_class' => function () {
                return Friend::class;
            },

            'receiver' => function ($authUser, $receiverId) {
                return $authUser;
            },

            'sender' => function ($authUser, $senderId) {
                if ($authUser->getKey() == $senderId) {
                    return $authUser;
                }

                return [MatchingUserFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $senderId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{sender_id}}',
                ]];
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [
            'auth_user' => ['auth_user_id'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'auth_user_id' => ['required'],

            'is_bidirectional' => ['boolean'],

            'receiver_id' => ['integer', 'same:{{auth_user_id}}'],

            'sender_id' => ['integer', 'different:{{nullable_receiver_id}}'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
