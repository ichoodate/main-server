<?php

namespace Database\Factories;

use App\Models\Localizable;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalizableFactory extends Factory
{
    protected $model = Localizable::class;

    public function definition()
    {
        return [
            Localizable::ID => $this->faker->unique()->randomNumber(8),

            Localizable::KEYWORD_ID => $this->faker->unique()->randomNumber(8),

            Localizable::LANGUAGE => $this->faker->randomElement(Localizable::LANGUAGE_VALUES),

            Localizable::TEXT => $this->faker->word,
        ];
    }
}
