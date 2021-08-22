<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Blood;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodFactory extends Factory
{
    protected $model = Blood::class;

    public function definition()
    {
        return [
            Blood::ID => $this->faker->unique()->randomNumber(8),

            Blood::TYPE => $this->faker->randomElement(Blood::TYPE_VALUES),
        ];
    }
}
