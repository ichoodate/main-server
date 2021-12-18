<?php

namespace App\Services\CardGroup;

use App\Models\CardGroup;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class CardGroupFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'card_group for {{id}}',
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
