<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Nationality;
use Faker\Generator as Faker;

class NationalityFactory extends ModelFactory {

    public static function default()
    {
        return [
            Nationality::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Nationality::COUNTRY_ID
                => inst(Faker::class)->unique()->randomNumber()
        ];
    }

}
