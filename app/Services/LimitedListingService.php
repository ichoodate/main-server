<?php

namespace App\Services;

use App\Service;
use App\Services\CursoringService;
use App\Services\ListingService;
use App\Services\PagingService;

class LimitedListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.limit' => ['query', 'limit', function ($query, $limit) {

                $query->take($limit);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'cursor' => ['model_class', 'cursor_id', function ($modelClass, $cursorId) {

                throw new \Exception;
            }],

            'limit' => [function () {

                return 120;
            }],

            'result' => ['cursor', 'limit', 'order_by_list', 'page', 'query', function ($cursor='', $limit, $orderByList='', $page='', $query) {

                if ( $page !== '' )
                {
                    return [PagingService::class, [
                        'limit'
                            => $limit,
                        'page'
                            => $page,
                        'query'
                            => $query,
                    ], [
                        'page'
                            => '{{page}}',
                    ]];
                }
                else
                {
                    return [CursoringService::class, [
                        'cursor'
                            => $cursor,
                        'limit'
                            => $limit,
                        'order_by_list'
                            => $orderByList,
                        'query'
                            => $query,
                    ]];
                }
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
            'cursor_id'
                => ['integer'],

            'limit'
                => ['required', 'integer', 'max:120']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }
}
