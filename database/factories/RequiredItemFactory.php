<?php

namespace Database\Factories;

use App\Models\RequiredItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequiredItemFactory extends Factory
{
    protected $model = RequiredItem::class;

    public function definition()
    {
        return [
            RequiredItem::WHEN => $this->faker->randomElement(['card_flip']),

            RequiredItem::TYPE => $this->faker->randomElement(['coin', 'subscription']),

            RequiredItem::COUNT => $this->faker->numberBetween(0, 20),
        ];
    }
}
