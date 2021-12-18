<?php

namespace App\Services\Popularity;

use App\Models\Popularity;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class PopularityFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'popularity for {{id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'available_expands' => function () {
                return ['receiver', 'sender'];
            },

            'model_class' => function () {
                return Popularity::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [
                    $model->{Popularity::SENDER_ID}, $model->{Popularity::RECEIVER_ID},
                ])) {
                    return $authUser;
                }
            },
        ];
    }

    public static function getPromiseLists()
    {
        return [];
    }

    public static function getRuleLists()
    {
        return [];
    }

    public static function getTraits()
    {
        return [
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
