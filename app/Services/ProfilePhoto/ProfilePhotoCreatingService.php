<?php

namespace App\Services\ProfilePhoto;

use App\Models\ProfilePhoto;
use FunctionalCoding\Service;

class ProfilePhotoCreatingService extends Service
{
    public static function getBindNames()
    {
        return [
            'data.*' => '{{data}}[*]',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'auth_user' => ['required'],

            'data' => ['required', 'array'],

            'data.*' => ['base64_image'],
        ];
    }

    public static function getTraits()
    {
        return [];
    }
}
