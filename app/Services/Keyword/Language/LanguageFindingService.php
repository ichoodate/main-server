<?php

namespace App\Services\Keyword\Language;

use App\Database\Models\Keyword\Language;
use App\Service;
use App\Services\FindingService;

class LanguageFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'language keyword for {{id}}'
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

                return Language::class;
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
