<?php

namespace Database\Factories\Keyword;

use App\Models\Keyword\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition()
    {
        return [
            Language::ID => $this->faker->unique()->randomNumber(8),

            Language::TYPE => $this->faker->unique()->randomElement(Language::TYPE_VALUES),
        ];
    }
}
