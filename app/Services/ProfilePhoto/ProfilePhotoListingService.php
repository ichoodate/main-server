<?php

namespace App\Services\ProfilePhoto;

use App\Models\ProfilePhoto;
use App\Services\User\UserFindingService;
use FunctionalCoding\Illuminate\Service\PaginationListService;
use FunctionalCoding\Service;

class ProfilePhotoListingService extends Service
{
    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.user' => function ($query, $user) {
                $query->qWhere(ProfilePhoto::USER_ID, $user->getKey());
            },
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'available_expands' => function () {
                return ['user'];
            },

            'cursor' => function ($cursorId) {
                return [ProfilePhotoFindingService::class, [
                    'id' => $cursorId,
                ], [
                    'id' => '{{cursor_id}}',
                ]];
            },

            'model_class' => function () {
                return ProfilePhoto::class;
            },

            'user' => function ($userId) {
                return [UserFindingService::class, [
                    'id' => $userId,
                ], [
                    'id' => '{{user_id}}',
                ]];
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
            'user_id' => ['required', 'integer'],
        ];
    }

    public static function getArrTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
