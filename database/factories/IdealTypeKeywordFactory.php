<?php

namespace Database\Factories;

use App\Models\IdealTypeKeyword;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdealTypeKeywordFactory extends Factory
{
    protected $model = IdealTypeKeyword::class;

    public function definition()
    {
        return [
            IdealTypeKeyword::ID => $this->faker->unique()->randomNumber(8),

            IdealTypeKeyword::USER_ID => $this->faker->unique()->randomNumber(8),

            IdealTypeKeyword::KEYWORD_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
