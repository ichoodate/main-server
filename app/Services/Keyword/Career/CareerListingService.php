<?php

namespace App\Services\Keyword\Career;

use App\Database\Models\Keyword\Career;
use Illuminate\Extend\Service;
use App\Services\ListingService;

class CareerListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.parent_id' => function ($parentId, $query) {

                $query->qWhere('parent_id', $parentId);
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => function () {

                return Career::class;
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
            'parent_id'
                => ['present', 'integer', 'nullable']
        ];
    }

    public static function getArrTraits()
    {
        return [
            ListingService::class,
        ];
    }

}
