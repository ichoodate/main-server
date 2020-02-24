<?php

namespace App\Services\CardGroup;

use App\Database\Models\CardGroup;
use App\Service;
use App\Services\PagingService;

class CardGroupPagingService extends Service {

    public static function getArrBindNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'query.timezone' => ['query', 'after', 'timezone', function ($query, $after, $timezone) {

                $time = new \DateTime($after, new \DateTimeZone($timezone));
                $time->setTimezone(new \DateTimeZone('UTC'));

                $query->qWhere(CardGroup::CREATED_AT, '>=', $time->format('Y-m-d H:i:s'));
            }],

            'query.auth_user' => ['query', 'auth_user', function ($query, $authUser) {

                $query->qWhere(CardGroup::USER_ID, $authUser->getKey());
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'cursor' => ['auth_user', 'cursor_id', function ($authUser, $cursorId) {

                return [CardGroupFindingService::class, [
                    'auth_user'
                        => $authUser,
                    'id'
                        => $cursorId
                ], [
                    'auth_user'
                        => '{{auth_user}}',
                    'id'
                        => '{{cursor_id}}'
                ]];
            }],

            'model_class' => [function () {

                return CardGroup::class;
            }]
        ];
    }

    public static function getArrPromiseLists()
    {
        return [];
    }

    public static function getArrRuleLists()
    {
        return [
            'after'
                => ['required', 'date_format:Y-m-d'],

            'auth_user'
                => ['required'],

            'timezone'
                => ['required', 'timezone']
        ];
    }

    public static function getArrTraits()
    {
        return [
            PagingService::class
        ];
    }

}
