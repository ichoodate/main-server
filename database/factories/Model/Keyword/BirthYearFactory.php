<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\BirthYear;

class BirthYearFactory extends ModelFactory {

    public static function default()
    {
        return [
            BirthYear::ID
                => static::faker()->unique()->randomNumber(8),

            BirthYear::YEAR
                => static::faker()->numberBetween(1950, (new \DateTime)->format('Y'))
        ];
    }

}
