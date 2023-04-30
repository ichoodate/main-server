<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\CardGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CardGroupFactory extends Factory
{
    protected $model = CardGroup::class;

    public function createAll($data = [], ?Model $parent = null)
    {
        $attrs = Arr::only($data, array_keys((new static())->definition()));
        $model = parent::create($attrs, $parent);
        $data = Arr::add($data, CardGroup::CARDS, []);

        foreach ($data[CardGroup::CARDS] as $card) {
            $card[Card::GROUP_ID] = $data[CardGroup::ID];
            $card[Card::CHOOSER_ID] = $data[CardGroup::USER_ID];

            Card::factory()->createAll($card);
        }

        return $model;
    }

    public function definition()
    {
        return [
            CardGroup::USER_ID => $this->faker->unique()->randomNumber(8),

            CardGroup::TYPE => $this->faker->randomElement(CardGroup::TYPE_VALUES),

            CardGroup::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
