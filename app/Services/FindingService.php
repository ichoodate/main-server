<?php

namespace App\Services;

use App\Service;

class FindingService extends Service {

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

            'model' => ['model_class', 'id', function ($modelClass, $id) {

                return inst($modelClass)->find($id);
            }],

            'result' => ['model', function ($model) {

                return $model;
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
            'id' => ['required', 'integer'],

            'model' => ['not_null']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
