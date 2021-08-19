<?php

namespace App\Services\CardFlip;

use App\Models\CardFlip;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class CardFlipFindingService extends Service
{
    public static function getArrBindNames()
    {
        return [
            'model' => 'card_flip for {{id}}',
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
                return ['user', 'card.concrete'];
            },

            'model_class' => function () {
                return CardFlip::class;
            },

            'permitted_user' => function ($authUser, $model) {
                if ($authUser->getkey() == $model->{CardFlip::USER_ID}) {
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
