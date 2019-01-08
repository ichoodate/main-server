<?php

namespace App\Services\FacePhoto;

use App\Database\Models\FacePhoto;
use App\Service;
use App\Services\AuthUserRequiringService;

class FacePhotoUpdatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user.' => ['auth_user', function ($authUser) {

                inst(FacePhoto::class)->aliasQuery()
                    ->qWhere(FacePhoto::USER_ID, $authUser->getKey())
                    ->delete();
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['upload', 'auth_user', function ($upload, $authUser) {

                return inst(FacePhoto::class)->create([
                    FacePhoto::USER_ID => $authUser->getKey(),
                    FacePhoto::DATA    => $upload
                ]);
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
            'upload'
                => ['required', 'base64_image']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class
        ];
    }

}
