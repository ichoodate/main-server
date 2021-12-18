<?php

namespace App\Services\CardFlip;

use App\Models\CardFlip;
use App\Services\PermittedUserRequiringService;
use FunctionalCoding\ORM\Eloquent\Service\FindService;
use FunctionalCoding\Service;

class CardFlipFindingService extends Service
{
    public static function getBindNames()
    {
        return [
            'model' => 'card_flip for {{id}}',
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
                return ['user', 'card'];
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
