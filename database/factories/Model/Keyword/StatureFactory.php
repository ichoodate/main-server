<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\Stature;

class StatureFactory extends ModelFactory {

    public static function default()
    {
        $cm = static::faker()->numberBetween(140, 200);

        return [
            Stature::ID
                => static::faker()->unique()->randomNumber(8),

            Stature::CM
                => $cm,

            Stature::INCH
                => (int)($cm * 0.393701),
        ];
    }

}
