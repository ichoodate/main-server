<?php

namespace App\Services\ChattingContent;

use App\Models\ChattingContent;
use App\Models\Friend;
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
            'query.group_by_match_id' => function ($authUser, $groupBy, $query) {
                if ('match_id' == $groupBy) {
                    $nestedSubquery1 = ChattingContent::query()
                        ->select(ChattingContent::MATCH_ID)
                        ->whereIn(
                            ChattingContent::MATCH_ID,
                            Friend::query()
                                ->select([Friend::MATCH_ID])
                                ->where(Friend::SENDER_ID, $authUser->getKey())
                        )
                        ->groupBy(ChattingContent::MATCH_ID)
                    ;
                    $nestedSubquery2 = ChattingContent::query()
                        ->select(ChattingContent::MATCH_ID)
                        ->where(
                            ChattingContent::SENDER_ID,
                            $authUser->getKey()
                        )
                        ->groupBy(ChattingContent::MATCH_ID)
                    ;
                    $subquery = ChattingContent::query()
                        ->select(
                            DB::raw(ChattingContent::MATCH_ID.' as '.ChattingContent::MATCH_ID.'2'),
                            DB::raw('max('.ChattingContent::CREATED_AT.') as '.ChattingContent::CREATED_AT.'2')
                        )
                        ->whereIn(ChattingContent::MATCH_ID, $nestedSubquery1->union($nestedSubquery2))
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
                }
            },

            'query.match' => function ($match, $query) {
                $query->where(ChattingContent::MATCH_ID, $match->getKey());
            },
        ];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['match', 'match.user', 'match.user.facePhoto', 'writer'];
            },

            'available_order_by' => function () {
                return ['created_at asc', 'created_at desc'];
            },

            'available_group_by' => function () {
                return ['match_id'];
            },

            'cursor' => function ($authUser, $cursorId) {
                return [ChattingContentFindingService::class, [
                    'auth_user' => $authUser,
                    'id' => $cursorId,
                ], [
                    'auth_user' => '{{auth_user}}',
                    'id' => '{{cursor_id}}',
                ]];
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

            'match_id' => ['integer'],

            'group_by' => ['required_without:{{match_id}}'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
