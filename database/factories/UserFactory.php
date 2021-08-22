<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            User::ID => $this->faker->unique()->randomNumber(8),

            User::EMAIL => $this->faker->unique()->email,

            User::PASSWORD => $this->faker->password,

            User::BIRTH => $this->faker->dateTime->format('Y-m-d'),

            User::GENDER => $this->faker->randomElement(User::GENDER_VALUES),

            User::NAME => $this->faker->name(),

            User::EMAIL_VERIFIED => $this->faker->boolean,

            User::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
