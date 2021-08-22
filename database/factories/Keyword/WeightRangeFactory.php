<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\WeightRange;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightRangeFactory extends Factory
{
    protected $model = WeightRange::class;

    public function definition()
    {
        return [
            WeightRange::ID => $this->faker->unique()->randomNumber(8),

            WeightRange::MIN => $this->faker->numberBetween(40, 80),

            WeightRange::MAX => $this->faker->numberBetween(60, 100),
        ];
    }
}
