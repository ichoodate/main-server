<?php

namespace Database\Factories;

use App\Models\Friend;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendFactory extends Factory
{
    protected $model = Friend::class;

    public function definition()
    {
        return [
            Friend::SENDER_ID => $this->faker->unique()->randomNumber(8),

            Friend::RECEIVER_ID => $this->faker->unique()->randomNumber(8),

            Friend::MATCH_ID => $this->faker->unique()->randomNumber(8),

            Friend::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
