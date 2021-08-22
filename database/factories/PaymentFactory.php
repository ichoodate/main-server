<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            Payment::ID => $this->faker->unique()->randomNumber(8),

            Payment::USER_ID => $this->faker->unique()->randomNumber(8),

            Payment::ITEM_ID => $this->faker->unique()->randomNumber(8),

            Payment::AMOUNT => $this->faker->randomNumber(),

            Payment::CURRENCY => $this->faker->currencyCode,

            Payment::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
