<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Country;
use Faker\Generator as Faker;

class CountryFactory extends ModelFactory {

    public static function default()
    {
        return [
            Country::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Country::DATA
                => inst(Faker::class)->randomElement(Country::DATA_VALUES)
        ];
    }

}
