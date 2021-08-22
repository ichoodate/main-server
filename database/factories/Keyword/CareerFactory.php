<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

class CareerFactory extends Factory
{
    protected $model = Career::class;

    public function definition()
    {
        return [
            Career::ID => $this->faker->unique()->randomNumber(8),

            Career::PARENT_ID => $this->faker->randomElement([app(Faker::class)->unique()->randomNumber(8), null]),

            Career::TYPE => $this->faker->randomElement(Career::TYPE_VALUES),

            Career::NAME => $this->faker->word,
        ];
    }
}
