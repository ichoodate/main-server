<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Weight;
use Database\Factories\ModelFactory;

class WeightFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Weight::ID => static::faker()->unique()->randomNumber(8),

            Weight::TYPE => static::faker()->numberBetween(40, 120),
        ];
    }
}
