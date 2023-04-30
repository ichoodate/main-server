<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrinkFactory extends Factory
{
    protected $model = Drink::class;

    public function definition()
    {
        return [
            Drink::TYPE => $this->faker->randomElement(Drink::TYPE_VALUES),
        ];
    }
}
