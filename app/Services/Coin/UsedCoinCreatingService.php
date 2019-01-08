<?php

namespace App\Services\Coin;

use App\Database\Models\Coin;
use App\Database\Models\User;
use App\Services\CreatingService;
use App\Service;

class UsedCoinCreatingService extends Service {

    public static function getArrBaseNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [
            'created' => ['created', 'auth_user', function ($created, $authUser) {

                $authUser->{User::COIN} = $authUser->{User::COIN} + $created->{Coin::COUNT};
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'created' => ['auth_user', 'count', function ($authUser, $count) {

                return inst(Coin::class)->create([
                    Coin::USER_ID
                        => $authUser->getKey(),
                    Coin::COUNT
                        => -1 * $count
                ]);
            }],

            'remain_coin' => ['auth_user', function ($authUser) {

                return $authUser->{User::COIN};
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
            'count' => ['required', 'integer'],

            'remain_coin' => ['integer', 'min:{{count}}']
        ];
    }

    public static function getArrTraits()
    {
        return [
            CreatingService::class
        ];
    }

}
