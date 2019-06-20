<?php

namespace App\Services\FacePhoto;

use App\Database\Models\FacePhoto;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class FacePhotoFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'face_photo for {{id}}'
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

                return FacePhoto::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( in_array($authUser->getKey(), [$model->{FacePhoto::USER_ID}]) )
                {
                    return $authUser;
                }
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
            PermittedUserRequiringService::class
        ];
    }

}
