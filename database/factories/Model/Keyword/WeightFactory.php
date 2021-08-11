<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\Weight;

class WeightFactory extends ModelFactory {

    public static function default()
    {
        return [
            Weight::ID
                => static::faker()->unique()->randomNumber(8),

            Weight::TYPE
                => static::faker()->numberBetween(40, 120)
        ];
    }

}
