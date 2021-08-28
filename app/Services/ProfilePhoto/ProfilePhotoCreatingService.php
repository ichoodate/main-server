<?php

namespace App\Services\ProfilePhoto;

use App\Models\ProfilePhoto;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\Service;

class ProfilePhotoCreatingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'data.*' => '{{data}}[*]',
        ];
    }

    public static function getArrCallbacks()
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

            'result' => function ($authUser, $data) {
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
            'data' => ['required', 'array'],

            'data.*' => ['base64_image'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }
}
