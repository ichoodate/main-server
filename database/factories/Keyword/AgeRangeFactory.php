<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\AgeRange;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgeRangeFactory extends Factory
{
    protected $model = AgeRange::class;

    public function definition()
    {
        return [
            AgeRange::MIN => $this->faker->numberBetween(20, 40),

            AgeRange::MAX => $this->faker->numberBetween(30, 50),
        ];
    }
}
