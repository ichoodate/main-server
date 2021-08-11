<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Models\Keyword\Nationality;

class NationalityFactory extends ModelFactory {

    public static function default()
    {
        return [
            Nationality::ID
                => static::faker()->unique()->randomNumber(8),

            Nationality::COUNTRY_ID
                => static::faker()->unique()->randomNumber(8)
        ];
    }

}
