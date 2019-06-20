<?php

namespace App\Services;

use App\Service;

class ListingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'available_expands'
                => 'options for {{expands}}',

            'available_order_by'
                => 'options for {{order_by}}',

            'available_group_by'
                => 'options for {{group_by}}',

            'available_fields'
                => 'options for {{fields}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.fields' => ['query', 'fields', function ($query, $fields) {

                $fields = preg_split('/\s*,\s*/', $fields);

                $query->qSelect($fields);
            }],

            'query.group_by' => ['query', 'group_by', function ($query, $groupBy) {

                $groupBy = preg_split('/\s*,\s*/', $groupBy);

                $query->qSelect($groupBy);
            }],

            'query.expands' => ['query', 'expands', function ($query, $expands) {

                $expands = preg_split('/\s*,\s*/', $expands);

                $query->with($expands);
            }],

            'query.order_by_list' => ['query', 'order_by_list', function ($query, $orderByList) {

                foreach ( $orderByList as $key => $direction )
                {
                    $query->qOrderBy($key, $direction);
                }
            }]
         ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => ['model_class', function ($model_class) {

                return inst($model_class)->getExpandable();
            }],

            'available_group_by' => [function () {

                return [];
            }],

            'available_fields' => ['model_class', function ($model_class) {

                $model = inst($model_class);

                return array_diff(array_merge($model->getFillable(), $model->getGuarded()), $model->getHidden());
            }],

            'available_order_by' => ['model_class', function ($modelClass) {

                if ( !in_array($modelClass::CREATED_AT, inst($modelClass)->getFillable()) )
                {
                    return ['id asc'];
                }
                else
                {
                    return ['created_at desc, id desc'];
                }
            }],

            'fields' => ['available_fields', function ($availableFields) {

                return implode(',', $availableFields);
            }],

            'model_class' => [function () {

                throw new \Exception;
            }],

            'query' => ['model_class', function ($modelClass) {

                return inst($modelClass)->query();
            }],

            'order_by_list' => ['available_order_by', 'order_by', function ($availableOrderBy, $orderBy='') {

                if ( empty($orderBy) && empty($availableOrderBy) )
                {
                    return [];
                }
                else if ( empty($orderBy) && !empty($availableOrderBy) )
                {
                    $orderBy = $availableOrderBy[0];
                }

                $orderBy = preg_replace('/\s+/', ' ', $orderBy);
                $orderBy = preg_replace('/\s*,\s*/', ',', $orderBy);
                $orders  = explode(',', $orderBy);
                $array   = [];

                foreach ( $orders as $order )
                {
                    $key       = explode(' ', $order)[0];
                    $direction = explode(' ', $order)[1];

                    $array[$key] = $direction;
                }

                return $array;
            }],

            'result' => ['query', function ($query) {

                $result = $query->get();

                return $result;
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
            'expands'
                => ['string', 'several_in:{{available_expands}}'],

            'fields'
                => ['string', 'several_in:{{available_fields}}'],

            'order_by'
                => ['string', 'several_in_array:{{available_order_by}}']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
