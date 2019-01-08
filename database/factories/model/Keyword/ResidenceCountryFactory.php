<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\ResidenceCountry;
use Faker\Generator as Faker;

class ResidenceCountryFactory extends ModelFactory {

    public static function default()
    {
        return [
            ResidenceCountry::ID
                => inst(Faker::class)->unique()->randomNumber(),

            ResidenceCountry::COUNTRY_ID
                => inst(Faker::class)->unique()->randomNumber()
        ];
    }

}
