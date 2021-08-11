<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\AgeRange;
use Database\Factories\ModelFactory;

class AgeRangeFactory extends ModelFactory
{
    public static function default()
    {
        return [
            AgeRange::ID => static::faker()->unique()->randomNumber(8),

            AgeRange::MIN => static::faker()->numberBetween(20, 40),

            AgeRange::MAX => static::faker()->numberBetween(30, 50),
        ];
    }
}
