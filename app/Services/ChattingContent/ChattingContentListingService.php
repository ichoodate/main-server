<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Services\Auth\AuthUserFindingService;
use App\Services\Matching\MatchingFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;
use Illuminate\Support\Facades\DB;

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
                if ('friend' == $type) {
                    $friendQuery = Friend::query()
                        ->select(Friend::MATCH_ID)
                        ->where(Friend::SENDER_ID, $authUser->getKey())
                        ->getQuery()
                    ;
                    $subquery = ChattingContent::query()
                        ->select(
                            DB::raw(ChattingContent::MATCH_ID.' as '.ChattingContent::MATCH_ID.'2'),
                            DB::raw('max('.ChattingContent::CREATED_AT.') as '.ChattingContent::CREATED_AT.'2')
                        )
                        ->whereIn(ChattingContent::MATCH_ID, $friendQuery)
                        ->groupBy(ChattingContent::MATCH_ID)
                    ;
                    $query->joinSub($subquery, 'latest_chattings', function ($join) use ($query) {
                        $join->on(
                            $query->from.'.'.ChattingContent::MATCH_ID,
                            '=',
                            'latest_chattings.'.ChattingContent::MATCH_ID.'2'
                        )->on(
                            $query->from.'.'.ChattingContent::CREATED_AT,
                            '=',
                            'latest_chattings.'.ChattingContent::CREATED_AT.'2'
                        );
                    });

                    $query->groupBy(ChattingContent::MATCH_ID);
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
