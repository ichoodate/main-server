<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\WeightRange;
use Database\Factories\ModelFactory;

class WeightRangeFactory extends ModelFactory
{
    public static function default()
    {
        return [
            WeightRange::ID => static::faker()->unique()->randomNumber(8),

            WeightRange::MIN => static::faker()->numberBetween(40, 80),

            WeightRange::MAX => static::faker()->numberBetween(60, 100),
        ];
    }
}
