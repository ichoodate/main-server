<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Matching\MatchingFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class ChattingContentListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.match' => function ($match, $query) {
                $query->where(ChattingContent::MATCH_ID, $match->getKey());
            },

            'query.type' => function ($authUser, $query, $type) {
                $authUserGenderColumn = User::GENDER_MAN == $authUser->{User::GENDER} ? Matching::MAN_ID : Matching::WOMAN_ID;

                $matchQuery = Matching::query()
                    ->select(Matching::ID)
                    ->where($authUserGenderColumn, $authUser->getKey())
                    ->getQuery()
                ;
                $friendQuery = Friend::query()
                    ->select(Friend::MATCH_ID)
                    ->whereIn(Friend::MATCH_ID, $matchQuery)
                    ->where(Friend::SENDER_ID, $authUser->getKey())
                    ->getQuery()
                ;

                if ('friend' == $type) {
                    $query->whereIn(ChattingContent::ID, function ($query) use ($friendQuery) {
                        $nestedQuery = ChattingContent::query()
                            ->select('id', 'match_id')
                            ->orderBy('created_at', 'desc')
                            ->whereIn(ChattingContent::MATCH_ID, $friendQuery)
                            ->limit(100) // 1000000000000000000
                            ->getQuery()
                        ;

                        $subQuery = app('db')
                            ->table($nestedQuery, 't')
                            ->select('id')
                            ->groupBy('match_id')
                        ;

                        $query
                            ->from($subQuery, 'tt')
                            ->select('id')
                        ;

                        return $query;
                    });
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

            'available_expands' => function () {
                return ['match', 'match.user', 'match.user.facePhoto', 'writer'];
            },

            'available_order_by' => function () {
                return ['created_at asc', 'created_at desc'];
            },

            'cursor' => function ($authToken, $cursorId) {
                return [ChattingContentFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $cursorId,
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => '{{cursor_id}}',
                ]];
            },

            'match' => function ($authToken, $matchId) {
                return [MatchingFindingService::class, [
                    'auth_token' => $authToken,
                    'id' => $matchId,
                ], [
                    'auth_token' => '{{auth_token}}',
                    'id' => '{{match_id}}',
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
            'match_id' => ['required_without:type', 'integer'],

            'type' => ['string', 'in:friend'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
