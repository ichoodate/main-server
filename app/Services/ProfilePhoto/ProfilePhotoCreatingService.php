<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Service;
use App\Services\CreatingService;

class ProfilePhotoCreatingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['upload', 'auth_user', function ($upload, $authUser) {

                return inst(ProfilePhoto::class)->create([
                    ProfilePhoto::USER_ID => $authUser->getKey(),
                    ProfilePhoto::DATA    => $upload
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
            'auth_user'
                => ['required'],

            'upload'
                => ['required', 'base64']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
