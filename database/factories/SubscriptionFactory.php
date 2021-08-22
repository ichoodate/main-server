<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            Subscription::ID => $this->faker->unique()->randomNumber(8),

            Subscription::USER_ID => $this->faker->unique()->randomNumber(8),

            Subscription::PAYMENT_ID => $this->faker->unique()->randomNumber(8),

            Subscription::TYPE => $this->faker->randomElement(Subscription::TYPE_VALUES),

            Subscription::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Subscription::DELETED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
