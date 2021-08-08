<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use Illuminate\Extend\Service;

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
            'created' => function ($authUser, $data) {

                $collection = (new ProfilePhoto)->newCollection();

                foreach ( $data as $k => $v )
                {
                    $collection->push((new ProfilePhoto)->create([
                        ProfilePhoto::USER_ID => $authUser->getKey(),
                        ProfilePhoto::DATA    => $v
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
            'auth_user'
                => ['required'],

            'data'
                => ['required', 'regex:/data:image\/([a-zA-Z]*);base64,([^\"]*)/'],
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
