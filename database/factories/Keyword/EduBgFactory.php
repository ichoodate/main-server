<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\EduBg;
use Illuminate\Database\Eloquent\Factories\Factory;

class EduBgFactory extends Factory
{
    protected $model = EduBg::class;

    public function definition()
    {
        return [
            EduBg::ID => $this->faker->unique()->randomNumber(8),

            EduBg::TYPE => $this->faker->randomElement(EduBg::TYPE_VALUES),
        ];
    }
}
