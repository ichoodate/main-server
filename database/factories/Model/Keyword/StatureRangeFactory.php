<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\StatureRange;
use Database\Factories\ModelFactory;

class StatureRangeFactory extends ModelFactory
{
    public static function default()
    {
        return [
            StatureRange::ID => static::faker()->unique()->randomNumber(8),

            StatureRange::MIN => static::faker()->numberBetween(140, 170),

            StatureRange::MAX => static::faker()->numberBetween(170, 200),
        ];
    }
}
