<?php

namespace Database\Factories;

use App\Models\CardFlip;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFlipFactory extends Factory
{
    protected $model = CardFlip::class;

    public function definition()
    {
        return [
            CardFlip::ID => $this->faker->unique()->randomNumber(8),

            CardFlip::USER_ID => $this->faker->unique()->randomNumber(8),

            CardFlip::CARD_ID => $this->faker->unique()->randomNumber(8),

            CardFlip::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
