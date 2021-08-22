<?php

namespace Database\Factories;

use App\Models\UserKeyword;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserKeywordFactory extends Factory
{
    protected $model = UserKeyword::class;

    public function definition()
    {
        return [
            UserKeyword::ID => $this->faker->unique()->randomNumber(8),

            UserKeyword::USER_ID => $this->faker->unique()->randomNumber(8),

            UserKeyword::KEYWORD_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
