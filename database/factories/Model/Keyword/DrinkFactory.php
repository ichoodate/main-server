<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Drink;

class DrinkFactory extends ModelFactory {

    public static function default()
    {
        return [
            Drink::ID
                => static::faker()->unique()->randomNumber(8),

            Drink::TYPE
                => static::faker()->randomElement(Drink::TYPE_VALUES)
        ];
    }

}
