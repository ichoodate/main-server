<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Country;

class CountryFactory extends ModelFactory {

    public static function default()
    {
        return [
            Country::ID
                => static::faker()->unique()->randomNumber(8),

            Country::ISO
                => static::faker()->countryCode,

            Country::NAME
                => static::faker()->country,

            Country::E164
                => static::faker()->e164PhoneNumber,

            Country::CCTLD
                => static::faker()->tld,

            Country::CURRENCY
                => static::faker()->countryCode,

            Country::LANGUAGE
                => static::faker()->languageCode
        ];
    }

}
