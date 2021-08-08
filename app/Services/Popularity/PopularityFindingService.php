<?php

namespace App\Services\Popularity;

use App\Database\Models\Popularity;
use App\Services\FindingService;
use App\Services\PermittedUserRequiringService;
use Illuminate\Extend\Service;

class PopularityFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'popularity for {{id}}',
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
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
            PermittedUserRequiringService::class,
        ];
    }
}
