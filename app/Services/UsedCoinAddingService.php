<?php

namespace App\Services;

use App\Database\Models\Balance;
use App\Database\Models\Coin;
use App\Service;

class UsedCoinAddingService extends Service {

    public static function getArrBindNames()
    {
        return [
            'remain_coin'
                => 'coin total count own by {{auth_user}}'
        ];
    }

    public static function getArrCallbackLists()
    {
        return [
            'used_coins' => ['used_coins', 'balances', function ($usedCoins, $balances) {

                foreach ( $usedCoins as $i => $usedCoin )
                {
                    $balance = $balances->get($i);
                    $balance->{Balance::COUNT} += $usedCoin->{Coin::COUNT};
                    $balance->save();
                }
            }]
        ];
    }

    public static function getArrLoaders()
    {
        return [
            'balances' => ['auth_user', 'timezone', function ($authUser, $timezone) {

                $time = new \DateTime('now', new \DateTimeZone($timezone));

                return (new Balance)->query()
                    ->qWhere(Balance::USER_ID, $authUser->getKey())
                    ->qWhere(Balance::DELETED_AT, '>=', $time->format('Y-m-d H:i:s'))
                    ->qOrderBy(Balance::DELETED_AT, 'asc')
                    ->get();
            }],

            'remain_coin' => ['balances', function ($balances) {

                return $balances->sum(Balance::COUNT);
            }],

            'required_coin' => [function () {

                throw new \Exception;
            }],

            'used_coins' => ['auth_user', 'result', 'required_coin', 'balances', function ($authUser, $result, $requiredCoin, $balances) {

                $counts    = [];
                $usedCoins = (new Coin)->newCollection();
                $i         = 0;

                while ( $requiredCoin != 0 )
                {
                    $balance = $balances->get($i);

                    if ( $balance->{Balance::COUNT} >= $requiredCoin )
                    {
                        $counts[] = $requiredCoin;
                        $requiredCoin = 0;
                    }
                    else
                    {
                        $counts[] = $balance->{Balance::COUNT};
                        $requiredCoin-= $balance->{Balance::COUNT};
                    }

                    $i++;
                }

                foreach ( $counts as $i => $count )
                {
                    $usedCoins->push((new Coin)->create([
                        Coin::BALANCE_ID
                            => $balances->get($i)->getKey(),
                        Coin::RELATED_ID
                            => $result->getKey(),
                        Coin::COUNT
                            => -1 * $count,
                        Coin::USER_ID
                            => $authUser->getKey()
                    ]));
                }

                return $usedCoins;
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
            'auth_user'
                => ['required'],

            'remain_coin'
                => ['integer', 'min:{{required_coin}}']
        ];
    }

    public static function getArrTraits()
    {
        return [];
    }

}
