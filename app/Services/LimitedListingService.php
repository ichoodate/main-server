<?php

namespace App\Services;

use FunctionalCoding\Service;

class LimitedListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.limit' => function ($limit, $query) {
                $query->take($limit);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'cursor' => function ($cursorId, $modelClass) {
                throw new \Exception();
            },

            'limit' => function () {
                return 120;
            },

            'result' => function ($cursor = '', $limit, $orderByList = '', $page = '', $query) {
                if ('' !== $page) {
                    return [PagingService::class, [
                        'limit' => $limit,
                        'page' => $page,
                        'query' => $query,
                    ], [
                        'page' => '{{page}}',
                    ]];
                }

                return [CursoringService::class, [
                    'cursor' => $cursor,
                    'limit' => $limit,
                    'order_by_list' => $orderByList,
                    'query' => $query,
                ]];
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'cursor_id' => ['integer'],

            'limit' => ['required', 'integer', 'max:120'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class,
        ];
    }
}
