<?php

namespace App\Services\FacePhoto;

use App\Models\FacePhoto;
use FunctionalCoding\Service;

class FacePhotoUpdatingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
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

    public static function getLoaders()
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

    public static function getPromiseLists()
    {
        return [
            'result' => ['auth_user'],
        ];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'data' => ['required', 'base64_image'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
