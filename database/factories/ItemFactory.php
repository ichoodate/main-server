<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            Item::TYPE => $this->faker->randomElement(Item::TYPE_VALUES),

            Item::ORIGINAL_PRICE => $this->faker->randomNumber(),

            Item::FINAL_PRICE => $this->faker->randomNumber(),

            Item::CURRENCY => $this->faker->currencyCode,

            Item::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Item::DELETED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
