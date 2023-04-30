<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\BirthYear;
use Illuminate\Database\Eloquent\Factories\Factory;

class BirthYearFactory extends Factory
{
    protected $model = BirthYear::class;

    public function definition()
    {
        return [
            BirthYear::TYPE => $this->faker->numberBetween(1950, (new \DateTime())->format('Y')),
        ];
    }
}
