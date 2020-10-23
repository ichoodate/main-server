<?php

namespace App\Services\Friend;

use App\Database\Models\Friend;
use App\Service;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;

class FriendFindingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'model'
                => 'friend for {{id}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => [function () {

                return ['match', 'receiver', 'sender'];
            }],

            'model_class' => [function () {

                return Friend::class;
            }],

            'permitted_user' => ['auth_user', 'model', function ($authUser, $model) {

                if ( in_array($authUser->getKey(), [$model->{Friend::USER_ID}]) )
                {
                    return $authUser;
                }
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [];
    }

    public static function getArrTraits()
    {
        return [
            FindingService::class,
            PermittedUserRequiringService::class
        ];
    }

}
