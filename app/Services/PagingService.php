<?php

namespace App\Services;

use App\Service;

class PagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.skip' => ['query', 'skip', function ($query, $skip) {

                $query->skip($skip);
            }],

            'query.limit' => ['query', 'limit', function ($query, $limit) {

                $query->take($limit);
            }],

            'query.cursor' => ['query', 'cursor', 'order_by_list', function ($query, $cursor, $orderByList) {

                foreach ( $orderByList as $key => $direction )
                {
                    if ( $direction == 'asc' )
                    {
                        $operator = '<=';
                    }
                    else
                    {
                        $operator = '>=';
                    }

                    $query->qWhere($key, $operator, $cursor->{$key});
                }

                if ( end($orderByList) == 'asc' )
                {
                    $operator = '<';
                }
                else
                {
                    $operator = '>';
                }

                $query->qWhere($cursor->getKeyName(), $operator, $cursor->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_order_by' => ['model_class', function ($modelClass) {

                if ( $modelClass::CREATED_AT == null )
                {
                    return ['id desc', 'id asc'];
                }
                else
                {
                    return ['created_at desc, id desc', 'created_at asc, id asc'];
                }
            }],

            'cursor' => [function () {

                throw new \Exception;
            }],

            'limit' => [function () {

                return 12;
            }],

            'page' => [function () {

                return 1;
            }],

            'skip' => ['page', 'limit', function ($page, $limit) {

                return ( $page - 1 ) * $limit;
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
                => ['integer', 'max:100'],

            'page'
                => ['integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
