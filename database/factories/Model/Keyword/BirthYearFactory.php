<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\BirthYear;
use Database\Factories\ModelFactory;

class BirthYearFactory extends ModelFactory
{
    public static function default()
    {
        return [
            BirthYear::ID => static::faker()->unique()->randomNumber(8),

            BirthYear::YEAR => static::faker()->numberBetween(1950, (new \DateTime())->format('Y')),
        ];
    }
}
