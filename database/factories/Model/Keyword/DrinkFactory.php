<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Drink;
use Database\Factories\ModelFactory;

class DrinkFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Drink::ID => static::faker()->unique()->randomNumber(8),

            Drink::TYPE => static::faker()->randomElement(Drink::TYPE_VALUES),
        ];
    }
}
