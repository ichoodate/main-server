<?php

namespace App\Services\ProfilePhoto;

use App\Database\Models\ProfilePhoto;
use App\Service;
use App\Services\PagingService;
use App\Services\ProfilePhoto\ProfilePhotoFindingService;
use App\Services\User\UserFindingService;

class ProfilePhotoPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.user' => ['query', 'user', function ($query, $user) {

                $query->qWhere(ProfilePhoto::USER_ID, $user->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'user' => ['user_id', function ($userId) {

                return [UserFindingService::class, [
                    'id'
                        => $userId
                ], [
                    'id'
                        => '{{user_id}}'
                ]];
            }],

            'cursor' => ['cursor_id', function ($cursorId) {

                return [ProfilePhotoFindingService::class, [
                    'id'
                        => $cursorId
                ], [
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'model_class' => [function () {

                return ProfilePhoto::class;
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
            'user_id'
                => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            PagingService::class
        ];
    }

}
