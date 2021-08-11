<?php

namespace App\Services\FacePhoto;

use App\Models\FacePhoto;
use FunctionalCoding\Service;

class FacePhotoCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'auth_user' => function ($authUser) {
                (new FacePhoto())->query()
                    ->qWhere(FacePhoto::USER_ID, $authUser->getKey())
                    ->delete()
                ;
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
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
            'auth_user' => ['required'],

            'data' => ['required', 'regex:/data:image\/([a-zA-Z]*);base64,([^\"]*)/'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
