<?php

namespace Database\Factories\Model;

use App\Database\Models\Item;
use Database\Factories\ModelFactory;

class ItemFactory extends ModelFactory {

    public static function default()
    {
        return [
            Item::ID
                => static::faker()->unique()->randomNumber(8),

            Item::TYPE
                => static::faker()->randomElement(Item::TYPE_VALUES),

            Item::ORIGINAL_PRICE
                => static::faker()->randomNumber(),

            Item::FINAL_PRICE
                => static::faker()->randomNumber(),

            Item::CURRENCY
                => static::faker()->currencyCode,

            Item::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Item::DELETED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
