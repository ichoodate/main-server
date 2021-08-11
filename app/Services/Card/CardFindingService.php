<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class CardFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'card for {{id}}',
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
                return ['flips', 'chooser', 'chooser.facePhoto', 'chooser.popularity', 'group', 'match', 'match.following', 'showner', 'showner.facePhoto', 'showner.popularity'];
            },

            'model_class' => function () {
                return Card::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [
                    $model->{Card::CHOOSER_ID}, $model->{Card::SHOWNER_ID},
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
            FindService::class,
            PermittedUserRequiringService::class,
        ];
    }
}
