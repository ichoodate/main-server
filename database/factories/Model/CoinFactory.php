<?php

namespace Database\Factories\Model;

use App\Models\Coin;
use Database\Factories\ModelFactory;

class CoinFactory extends ModelFactory
{
    public static function create(array $data = [])
    {
        return parent::create($data);
    }

    public static function default()
    {
        return [
            Coin::ID => static::faker()->unique()->randomNumber(8),

            Coin::USER_ID => static::faker()->unique()->randomNumber(8),

            Coin::RELATED_ID => static::faker()->unique()->randomNumber(8),

            Coin::CREATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
