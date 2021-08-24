<?php

namespace App\Services\FacePhoto;

use App\Models\FacePhoto;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class FacePhotoCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbacks()
    {
        return [
            'auth_user' => function ($authUser) {
                (new FacePhoto())->query()
                    ->where(FacePhoto::USER_ID, $authUser->getKey())
                    ->delete()
                ;
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'result' => function ($authUser, $data) {
                return (new FacePhoto())->create([
                    FacePhoto::USER_ID => $authUser->getKey(),
                    FacePhoto::DATA => $data,
                ]);
            },
        ];
    }

    public static function getArrPromiseLists()
    {
        return [
            'result' => ['auth_user'],
        ];
    }

    public static function getArrRuleLists()
    {
        return [
            'data' => ['required', 'base64_image'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
