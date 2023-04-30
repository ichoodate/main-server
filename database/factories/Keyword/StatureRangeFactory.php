<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\StatureRange;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatureRangeFactory extends Factory
{
    protected $model = StatureRange::class;

    public function definition()
    {
        return [
            StatureRange::MIN => $this->faker->numberBetween(140, 170),

            StatureRange::MAX => $this->faker->numberBetween(170, 200),
        ];
    }
}
