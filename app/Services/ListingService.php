<?php

namespace App\Services;

use FunctionalCoding\Service;

class ListingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'available_expands' => 'options for {{expands}}',

            'available_fields' => 'options for {{fields}}',

            'available_group_by' => 'options for {{group_by}}',

            'available_order_by' => 'options for {{order_by}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.fields' => function ($availableFields, $fields = '', $query) {
                $fields = $fields ? preg_split('/\s*,\s*/', $fields) : $availableFields;

                $query->qSelect($fields);
            },

            'query.group_by' => function ($groupBy, $query) {
                $groupBy = preg_split('/\s*,\s*/', $groupBy);

                $query->qSelect($groupBy);
            },

            'query.order_by_list' => function ($orderByList, $query) {
                foreach ($orderByList as $key => $direction) {
                    $query->qOrderBy($key, $direction);
                }
            },

            'result' => function ($expands, $result) {
                $expands = preg_split('/\s*,\s*/', $expands);

                $result->loadVisible($expands);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_fields' => function ($modelClass) {
                $model = inst($model_class);

                return array_diff(array_merge($model->getFillable(), $model->getGuarded()), $model->getHidden());
            },

            'available_group_by' => function () {
                return [];
            },

            'available_order_by' => function ($modelClass) {
                if (!in_array($modelClass::CREATED_AT, inst($modelClass)->getFillable())) {
                    return ['id asc'];
                }

                return ['created_at desc, id desc'];
            },

            'model_class' => function () {
                throw new \Exception();
            },

            'order_by_list' => function ($availableOrderBy, $orderBy = '') {
                if (empty($orderBy) && empty($availableOrderBy)) {
                    return [];
                }
                if (empty($orderBy) && !empty($availableOrderBy)) {
                    $orderBy = $availableOrderBy[0];
                }

                $orderBy = preg_replace('/\s+/', ' ', $orderBy);
                $orderBy = preg_replace('/\s*,\s*/', ',', $orderBy);
                $orders = explode(',', $orderBy);
                $array = [];

                foreach ($orders as $order) {
                    $key = explode(' ', $order)[0];
                    $direction = explode(' ', $order)[1];

                    $array[$key] = $direction;
                }

                return $array;
            },

            'query' => function ($modelClass) {
                return inst($modelClass)->query();
            },

            'result' => function ($query) {
                return $query->get();
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
            'expands' => ['string', 'several_in:{{available_expands}}'],

            'fields' => ['string', 'several_in:{{available_fields}}'],

            'order_by' => ['string', 'in_array:{{available_order_by}}.*'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
