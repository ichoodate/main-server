<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Country;
use Faker\Generator as Faker;

class CountryFactory extends ModelFactory {

    public static function default()
    {
        return [
            Country::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Country::ISO
                => inst(Faker::class)->countryCode,

            Country::NAME
                => inst(Faker::class)->country,

            Country::E164
                => inst(Faker::class)->e164PhoneNumber,

            Country::CCTLD
                => inst(Faker::class)->tld,

            Country::CURRENCY
                => inst(Faker::class)->countryCode,

            Country::LANGUAGE
                => inst(Faker::class)->languageCode
        ];
    }

}
