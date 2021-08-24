<?php

namespace App\Services\ProfilePhoto;

use App\Models\ProfilePhoto;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class ProfilePhotoCreatingService extends Service
{
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
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'created' => function ($authUser, $data) {
                $collection = (new ProfilePhoto())->newCollection();

                foreach ($data as $k => $v) {
                    $collection->push((new ProfilePhoto())->create([
                        ProfilePhoto::USER_ID => $authUser->getKey(),
                        ProfilePhoto::DATA => $v,
                    ]));
                }

                return $collection;
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
            'data' => ['required', 'regex:/data:image\/([a-zA-Z]*);base64,([^\"]*)/'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
