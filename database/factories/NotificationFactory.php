<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            Notification::USER_ID => $this->faker->unique()->randomNumber(8),

            Notification::RELATED_ID => $this->faker->unique()->randomNumber(8),

            Notification::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::UPDATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::DELETED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
