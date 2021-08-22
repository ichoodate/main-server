<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Weight;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightFactory extends Factory
{
    protected $model = Weight::class;

    public function definition()
    {
        return [
            Weight::ID => $this->faker->unique()->randomNumber(8),

            Weight::TYPE => $this->faker->numberBetween(40, 120),
        ];
    }
}
