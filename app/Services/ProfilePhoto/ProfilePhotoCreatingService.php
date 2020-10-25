<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use Illuminate\Extend\Service;
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
            'created' => ['data', 'auth_user', function ($data, $authUser) {

                $collection = (new ProfilePhoto)->newCollection();

                foreach ( $data as $k => $v )
                {
                    $collection->push((new ProfilePhoto)->create([
                        ProfilePhoto::USER_ID => $authUser->getKey(),
                        ProfilePhoto::DATA    => $v
                    ]));
                }

                return $collection;
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

            'data'
                => ['required', 'regex:/data:image\/([a-zA-Z]*);base64,([^\"]*)/'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
