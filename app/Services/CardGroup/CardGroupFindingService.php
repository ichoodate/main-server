<?php

namespace App\Services\CardGroup;

use App\Models\CardGroup;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\Illuminate\Service\FindService;
use FunctionalCoding\Service;

class CardGroupFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'card_group for {{id}}',
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
                return ['cards.flips', 'cards.chooser.facePhoto', 'cards.chooser.popularity', 'cards.showner.facePhoto', 'cards.showner.popularity', 'user'];
            },

            'model_class' => function () {
                return CardGroup::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if (in_array($authUser->getKey(), [$model->{CardGroup::USER_ID}])) {
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
