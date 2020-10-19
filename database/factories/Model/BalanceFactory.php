<?php

namespace Database\Factories\Model;

use App\Database\Models\Balance;
use Database\Factories\ModelFactory;

class BalanceFactory extends ModelFactory {

    public static function default()
    {
        return [
            Balance::ID
                => static::faker()->unique()->randomNumber(8),

            Balance::USER_ID
                => static::faker()->unique()->randomNumber(8),

            Balance::TYPE
                => static::faker()->randomElement(Balance::TYPE_VALUES),

            Balance::COUNT
                => static::faker()->unique()->randomNumber(8),

            Balance::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Balance::DELETED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
