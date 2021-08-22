<?php

namespace Database\Factories\Keyword;

use App\Models\AgeRange;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgeRangeFactory extends Factory
{
    protected $model = AgeRange::class;

    public function definition()
    {
        return [
            AgeRange::ID => $this->faker->unique()->randomNumber(8),

            AgeRange::MIN => $this->faker->numberBetween(20, 40),

            AgeRange::MAX => $this->faker->numberBetween(30, 50),
        ];
    }
}
