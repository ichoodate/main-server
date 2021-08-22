<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    protected $model = Balance::class;

    public function definition()
    {
        return [
            Balance::ID => $this->faker->unique()->randomNumber(8),

            Balance::USER_ID => $this->faker->unique()->randomNumber(8),

            Balance::TYPE => $this->faker->randomElement(Balance::TYPE_VALUES),

            Balance::COUNT => $this->faker->unique()->randomNumber(8),

            Balance::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Balance::DELETED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
