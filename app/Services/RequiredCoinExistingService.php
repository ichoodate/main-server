<?php

namespace App\Services;

use App\Service;
use App\Services\Coin\UsedCoinCreatingService;

class RequiredCoinExistingService extends Service {

    public static function getArrBaseNames()
    {
        return [
            'used_coin' => [function () {

                throw new \Exception;
            }]
        ];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            'required_coin' => [function () {

                throw new \Exception;
            }],

            'used_coin' => ['auth_user', 'required_coin', function ($authUser, $requiredCoin) {

                if ( $requiredCoin > 0 )
                {
                    return [UsedCoinCreatingService::class, [
                        'auth_user'
                            => $authUser,
                        'count'
                            => $requiredCoin
                    ], [
                        'auth_user'
                            => '{{auth_user}}',
                        'count'
                            => '{{required_coin}}'
                    ]];
                }
            }]
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
        return [];
    }

}
