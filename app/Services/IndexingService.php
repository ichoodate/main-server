<?php

namespace App\Services\User;

use App\Database\Models\User;
use App\Service;

class IndexingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                throw new \Exception;
            }],

            'model' => ['model_class', function ($modelClass) {

                return $modelClass::query();
            }],

            'result_type' => [function () {

                return ['listing', 'limiting', 'paging', 'cursoring'];
            }],

            'result' => ['cursor', 'expands', 'fields', 'group_by', 'order_by', function ($cursor, $expands, $fields, $groupBy, $orderBy) {

                if ( $cursor )
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
