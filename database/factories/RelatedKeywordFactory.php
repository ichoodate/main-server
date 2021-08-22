<?php

namespace Database\Factories;

use App\Models\RelatedKeyword;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelatedKeywordFactory extends Factory
{
    protected $model = RelatedKeyword::class;

    public function definition()
    {
        return [
            RelatedKeyword::ID => $this->faker->unique()->randomNumber(8),

            RelatedKeyword::IDEAL_TYPE_KWD_ID => $this->faker->unique()->randomNumber(8),

            RelatedKeyword::MATCHING_KWD_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
