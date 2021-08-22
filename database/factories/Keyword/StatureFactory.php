<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Stature;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatureFactory extends Factory
{
    protected $model = Stature::class;

    public function definition()
    {
        $cm = $this->faker->numberBetween(140, 200);

        return [
            Stature::ID => $this->faker->unique()->randomNumber(8),

            Stature::CM => $cm,

            Stature::INCH => (int) ($cm * 0.393701),
        ];
    }
}
