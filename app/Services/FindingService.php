<?php

namespace App\Services;

use FunctionalCoding\Service;

class FindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'available_expands' => 'options for {{expands}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'result' => function ($expands, $result) {
                $expands = preg_split('/\s*,\s*/', $expands);
                $collection = $result->newCollection();
                $collection->push($result);
                $collection->loadVisible($expands);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return [];
            },

            'model' => function ($id, $modelClass) {
                return app($modelClass)->find($id);
            },

            'model_class' => function () {
                throw new \Exception();
            },

            'result' => function ($model) {
                return $model;
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
            'expands' => ['several_in:{{available_expands}}'],

            'id' => ['required', 'integer'],

            'model' => ['not_null'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
