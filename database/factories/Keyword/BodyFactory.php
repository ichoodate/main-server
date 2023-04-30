<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Body;
use Illuminate\Database\Eloquent\Factories\Factory;

class BodyFactory extends Factory
{
    protected $model = Body::class;

    public function definition()
    {
        return [
            Body::TYPE => $this->faker->randomElement(Body::TYPE_VALUES),
        ];
    }
}
