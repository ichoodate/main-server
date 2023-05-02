<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition()
    {
        return [
            Country::ISO => $this->faker->unique()->countryCode,

            Country::NAME => $this->faker->country,

            Country::E164 => $this->faker->unique()->randomNumber(3),

            Country::CCTLD => $this->faker->tld,

            Country::CURRENCY => $this->faker->countryCode,

            Country::LANGUAGE => $this->faker->languageCode,
        ];
    }
}
