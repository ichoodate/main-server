<?php

namespace App\Services\Coin;

use App\Database\Models\Coin;
use App\Service;

class AddedCoinCreatingService extends Service {

    public static function getArrBaseNames()
    {
        return [];
    }

    public static function getArrCallbackLists()
    {
        return [];
    }

    public static function getArrLoaders()
    {
        return [
            // 'payment' => ...
            'created' => ['auth_user', 'count', function ($authUser, $count) {

                return inst(Coin::class)->create([
                    Coin::USER_ID
                        => $authUser->getKey(),
                    Coin::COUNT
                        => $count
                ]);
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
            'count' => ['required', 'integer']
        ];
    }

    public static function getArrTraits()
    {
        return [
            AuthUserRequiringService::class,
            CreatingService::class
        ];
    }

}
