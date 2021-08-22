<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Residence;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResidenceFactory extends Factory
{
    protected $model = Residence::class;

    public function definition()
    {
        return [
            Residence::ID => $this->faker->unique()->randomNumber(8),

            Residence::PARENT_ID => $this->faker->unique()->randomNumber(8),

            Residence::RELATED_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
