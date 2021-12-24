<?php

namespace App\Services\RequiredItem;

use App\Models\Card;
use App\Models\RequiredItem;
use App\Relation;
use App\Services\Auth\AuthUserFindingService;
use FunctionalCoding\ORM\Eloquent\Service\ListService;
use FunctionalCoding\Service;

class RequiredItemListingService extends Service
{
    public static function getBindNames()
    {
        return [
            'auth_user' => 'authorized user',

            'related' => '{{related_type}} for {{related_id}}',
        ];
    }

    public static function getCallbacks()
    {
        return [];
    }

    public static function getLoaders()
    {
        return [
            'auth_user' => function ($authToken = '') {
                return [AuthUserFindingService::class, [
                    'auth_token' => $authToken,
                ], [
                    'auth_token' => '{{auth_token}}',
                ]];
            },

            'available_expands' => function () {
                return [];
            },

            'model_class' => function () {
                return RequiredItem::class;
            },

            'related' => function ($relatedId, $relatedType) {
                $class = Relation::morphMap()[$relatedType];

                return $class::find($relatedId);
            },

            'result' => function ($authUser, $related) {
                if (Card::class == get_class($related) && $related->{Card::CHOOSER_ID} == $authUser->getKey()) {
                    return [ChooserCardFlipRequiredItemListingService::class, [
                        'auth_user' => $authUser,
                        'card' => $related,
                    ], [
                        'auth_user' => '{{auth_user}}',
                        'card' => '{{related}}',
                    ]];
                }
                if (Card::class == get_class($related) && $related->{Card::SHOWNER_ID} == $authUser->getKey()) {
                    return [ShownerCardFlipRequiredItemListingService::class, [
                        'card' => $card,
                    ], [
                        'card' => '{{card}}',
                    ]];
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
        return [
            'related_id' => ['required', 'integer'],

            'related_type' => ['required', 'in:'.implode(',', array_keys(Relation::morphMap()))],
        ];
    }

    public static function getTraits()
    {
        return [
            ListService::class,
        ];
    }
}
