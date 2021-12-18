<?php

namespace App\Services\ProfilePhoto;

use App\Models\ProfilePhoto;
use App\Services\User\UserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\PaginationListService;
use FunctionalCoding\Service;

class ProfilePhotoListingService extends Service
{
    public static function getBindNames()
    {
        return [];
    }

    public static function getCallbacks()
    {
        return [
            'query.user' => function ($query, $user) {
                $query->where(ProfilePhoto::USER_ID, $user->getKey());
            },
        ];
    }

    public static function getLoaders()
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

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [
            'user_id' => ['required', 'integer'],
        ];
    }

    public static function getTraits()
    {
        return [
            PaginationListService::class,
        ];
    }
}
