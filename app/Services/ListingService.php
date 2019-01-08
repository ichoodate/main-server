<?php

namespace App\Services;

use App\Service;

class ListingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'available_fields' => 'options for {{fields}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.fields' => ['query', 'fields', function ($query, $fields) {

                $fields = preg_split('/\s*,\s*/', $fields);

                $query->qSelect($fields);
            }]
         ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_fields' => ['model_class', function ($model_class) {

                return inst($model_class)->getVisible();
            }],

            'fields' => ['available_fields', function ($availableFields) {

                return implode(',', $availableFields);
            }],

            'model_class' => [function () {

                throw new \Exception;
            }],

            'query' => ['model_class', function ($modelClass) {

                return inst($modelClass)->aliasQuery();
            }],

            'result' => ['query', function ($query) {

                return $query->get();
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
            'fields' => ['several_in:{{available_fields}}']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
