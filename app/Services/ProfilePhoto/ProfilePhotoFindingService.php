<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Service;
use App\Services\FindingService;

class ProfilePhotoFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'profile_photo for {{id}}'
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

                return ProfilePhoto::class;
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
            FindingService::class,
        ];
    }

}
