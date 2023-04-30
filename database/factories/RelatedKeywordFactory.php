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
            RelatedKeyword::RELATED_ID => $this->faker->unique()->randomNumber(8),

            RelatedKeyword::KEYWORD_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
