<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Service;
use App\Services\AuthUserRequiringService;

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
            'created' => ['uploads', 'auth_user', function ($uploads, $authUser) {

                $photos = inst(ProfilePhoto::class)->newCollection();

                foreach ( $uploads as $i => $upload )
                {
                    $photo = inst(ProfilePhoto::class)->create([
                        ProfilePhoto::USER_ID => $authUser->getKey(),
                        ProfilePhoto::DATA    => $upload
                    ]);

                    $photos->push($photo);
                }

                return $photos;
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
            'uploads'
                => ['required', 'array'],

            'uploads.*'
                => ['base64_image']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class
        ];
    }

}
