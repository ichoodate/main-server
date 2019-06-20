<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\Nationality;
use Faker\Generator as Faker;

class NationalityFactory extends ModelFactory {

    public static function default()
    {
        return [
            Nationality::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Nationality::COUNTRY_ID
                => inst(Faker::class)->unique()->randomNumber(8)
        ];
    }

}
