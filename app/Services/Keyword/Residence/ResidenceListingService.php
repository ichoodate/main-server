<?php

namespace App\Services\Keyword\Residence;

use App\Database\Models\Keyword\Residence;
use App\Service;
use App\Services\ListingService;

class ResidenceListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.parent_id' => ['query', 'parent_id', function ($query, $parentId) {

                $query->qWhere('parent_id', $parentId);
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return Residence::class;
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
            ListingService::class
        ];
    }

}
