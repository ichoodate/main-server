<?php

namespace Database\Factories;

use App\Models\Popularity;
use Illuminate\Database\Eloquent\Factories\Factory;

class PopularityFactory extends Factory
{
    protected $model = Popularity::class;

    public function definition()
    {
        return [
            Popularity::SENDER_ID => $this->faker->unique()->randomNumber(8),

            Popularity::RECEIVER_ID => $this->faker->unique()->randomNumber(8),

            Popularity::POINT => $this->faker->numberBetween(0, 10),

            Popularity::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
