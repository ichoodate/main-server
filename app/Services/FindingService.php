<?php

namespace App\Services;

use App\Service;

class FindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'available_expands'
                => 'options for {{expands}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'result' => ['result', 'expands', function ($result, $expands) {

                $collection = $result->newCollection();

                $collection->push($result);
                $collection->load($expands);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => ['model_class', function ($model_class) {

                return inst($model_class)->getExpandable();
            }],

            'model' => ['model_class', 'id', function ($modelClass, $id) {

                return inst($modelClass)->find($id);
            }],

            'model_class' => [function () {

                throw new \Exception;
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
            'expands'
                => ['several_in:{{available_expands}}'],

            'id'
                => ['required', 'integer'],

            'model'
                => ['not_null']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
