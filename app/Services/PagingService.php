<?php

namespace App\Services;

use App\Service;

class PagingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'available_order_by' => 'options for {{order_by}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.order_by_list' => ['query', 'order_by_list', function ($query, $orderByList) {

                foreach ( $orderByList as $key => $direction )
                {
                    $query->qOrderBy($key, $direction);
                }
            }],

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
            'available_order_by_fields' => ['model_class', function ($model_class) {

                return [
                    $model_class::CREATED_AT
                ];
            }],

            'available_order_by' => ['available_order_by_fields', function ($availableOrderByFields) {

                $orderBy = [];

                foreach ( $availableOrderByFields as $field )
                {
                    $orderBy[] = $field . ' asc';
                    $orderBy[] = $field . ' desc';
                }

                return $orderBy;
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

            'order_by_list' => ['order_by', function ($orderBy) {

                $orderBy = preg_replace('/\s+/', ' ', $orderBy);
                $orderBy = preg_replace('/\s*,\s*/', ',', $orderBy);
                $orders  = explode(',', $orderBy);
                $return  = [];

                foreach ( $orders as $order )
                {
                    $t = explode(' ', $order);

                    $return[$t[0]] = $t[1];
                }

                return $return;
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
            'id' => ['integer'],

            'limit' => ['integer', 'max:100'],

            'order_by' => ['string', 'several_in_array:{{available_order_by}}'],

            'page' => ['integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class
        ];
    }

}
