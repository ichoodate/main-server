<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\StatureRange;

class StatureRangeFactory extends ModelFactory {

    public static function default()
    {
        return [
            StatureRange::ID
                => static::faker()->unique()->randomNumber(8),

            StatureRange::MIN
                => static::faker()->numberBetween(140, 170),

            StatureRange::MAX
                => static::faker()->numberBetween(170, 200)
        ];
    }

}
