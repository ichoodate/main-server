<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Smoke;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmokeFactory extends Factory
{
    protected $model = Smoke::class;

    public function definition()
    {
        return [
            Smoke::ID => $this->faker->unique()->randomNumber(8),

            Smoke::TYPE => $this->faker->randomElement(Smoke::TYPE_VALUES),
        ];
    }
}
