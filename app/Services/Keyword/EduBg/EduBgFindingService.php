<?php

namespace App\Services\Keyword\EduBg;

use App\Database\Models\Keyword\EduBg;
use App\Service;
use App\Services\FindingService;

class EduBgFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'education_background keyword for {{id}}'
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

                return EduBg::class;
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
        return [
            FindingService::class
        ];
    }

}
