<?php

namespace App\Services\Notice;

use App\Database\Models\Notice;
use App\Service;

class NoticeFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'notice of {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Notice::class;
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
