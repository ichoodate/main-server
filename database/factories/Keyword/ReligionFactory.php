<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Religion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReligionFactory extends Factory
{
    protected $model = Religion::class;

    public function definition()
    {
        return [
            Religion::TYPE => $this->faker->randomElement(Religion::TYPE_VALUES),
        ];
    }
}
