<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Hobby;
use Illuminate\Database\Eloquent\Factories\Factory;

class HobbyFactory extends Factory
{
    protected $model = Hobby::class;

    public function definition()
    {
        return [
            Hobby::ID => $this->faker->unique()->randomNumber(8),

            Hobby::TYPE => $this->faker->randomElement(Hobby::TYPE_VALUES),
        ];
    }
}
