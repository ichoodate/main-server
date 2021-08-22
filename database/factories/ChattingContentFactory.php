<?php

namespace Database\Factories;

use App\Models\ChattingContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChattingContentFactory extends Factory
{
    protected $model = ChattingContent::class;

    public function definition()
    {
        return [
            ChattingContent::ID => $this->faker->unique()->randomNumber(8),

            ChattingContent::MATCH_ID => $this->faker->unique()->randomNumber(8),

            ChattingContent::WRITER_ID => $this->faker->unique()->randomNumber(8),

            ChattingContent::MESSAGE => $this->faker->word,

            ChattingContent::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
