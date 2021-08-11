<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Nationality;
use Database\Factories\ModelFactory;

class NationalityFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Nationality::ID => static::faker()->unique()->randomNumber(8),

            Nationality::COUNTRY_ID => static::faker()->unique()->randomNumber(8),
        ];
    }
}
