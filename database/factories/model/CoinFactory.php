<?php

namespace Database\Factories\Model;

use App\Database\Models\Coin;
use App\Database\Models\User;
use Faker\Generator as Faker;

class CoinFactory extends ModelFactory {

    public static function create(array $data = [])
    {
        $model = parent::create($data);

        return $model;
    }

    public static function default()
    {
        return [
            Coin::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Coin::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Coin::RELATED_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Coin::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
