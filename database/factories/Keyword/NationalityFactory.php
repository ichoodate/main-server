<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Nationality;
use Illuminate\Database\Eloquent\Factories\Factory;

class NationalityFactory extends Factory
{
    protected $model = Nationality::class;

    public function definition()
    {
        return [
            Nationality::ID => $this->faker->unique()->randomNumber(8),

            Nationality::COUNTRY_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
