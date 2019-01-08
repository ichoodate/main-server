<?php

namespace App\Services\FacePhoto;

use App\Database\Models\FacePhoto;
use App\Database\Models\User;
use App\Services\AuthUserRequiringService;
use App\Services\ListingService;
use App\Service;

class FacePhotoListingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(FacePhoto::USER_ID, $authUser->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'model_class' => [function () {

                return FacePhoto::class;
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
            AuthUserRequiringService::class,
            ListingService::class
        ];
    }

}
