<?php

namespace Database\Factories\Models;

use App\Database\Models\Item;
use Faker\Generator as Faker;

class ItemFactory extends ModelFactory {

    public static function default()
    {
        return [
            Item::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Item::TYPE
                => inst(Faker::class)->randomElement(Item::TYPE_VALUES),

            Item::ORIGINAL_PRICE
                => inst(Faker::class)->randomNumber(),

            Item::FINAL_PRICE
                => inst(Faker::class)->randomNumber(),

            Item::CURRENCY
                => inst(Faker::class)->currencyCode,

            Item::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Item::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
