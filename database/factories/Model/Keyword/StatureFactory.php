<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Stature;
use Database\Factories\ModelFactory;

class StatureFactory extends ModelFactory
{
    public static function default()
    {
        $cm = static::faker()->numberBetween(140, 200);

        return [
            Stature::ID => static::faker()->unique()->randomNumber(8),

            Stature::CM => $cm,

            Stature::INCH => (int) ($cm * 0.393701),
        ];
    }
}
