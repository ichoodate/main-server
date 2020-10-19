<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\AgeRange;

class AgeRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            AgeRange::ID
                => static::faker()->unique()->randomNumber(8),

            AgeRange::MIN
                => static::faker()->numberBetween(20, 40),

            AgeRange::MAX
                => static::faker()->numberBetween(30, 50)
        ];
    }

}
