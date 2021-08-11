<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\WeightRange;

class WeightRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            WeightRange::ID
                => static::faker()->unique()->randomNumber(8),

            WeightRange::MIN
                => static::faker()->numberBetween(40, 80),

            WeightRange::MAX
                => static::faker()->numberBetween(60, 100)
        ];
    }

}
