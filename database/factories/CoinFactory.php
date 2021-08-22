<?php

namespace Database\Factories;

use App\Models\Coin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoinFactory extends Factory
{
    protected $model = Coin::class;

    public function definition()
    {
        return [
            Coin::ID => $this->faker->unique()->randomNumber(8),

            Coin::USER_ID => $this->faker->unique()->randomNumber(8),

            Coin::RELATED_ID => $this->faker->unique()->randomNumber(8),

            Coin::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
