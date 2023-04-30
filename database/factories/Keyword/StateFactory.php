<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition()
    {
        return [
            State::COUNTRY_ID => $this->faker->unique()->randomNumber(8),

            State::NAME => $this->faker->word,
        ];
    }
}
