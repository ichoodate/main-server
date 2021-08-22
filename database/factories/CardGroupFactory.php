<?php

namespace Database\Factories;

use App\Models\CardGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class CardGroupFactory extends Factory
{
    protected $model = CardGroup::class;

    public function create($data = [], ?Model $parent = null)
    {
        if (empty($data)) {
            return parent::create($data, $parent);
        }

        $attrs = array_only($data, array_keys((new static())->definition()));
        $model = $this->state($attrs)->create();
        $data = array_add($data, CardGroup::CARDS, []);

        foreach ($data[CardGroup::CARDS] as $card) {
            $card[Card::GROUP_ID] = $data[CardGroup::ID];
            $card[Card::CHOOSER_ID] = $data[CardGroup::USER_ID];

            Card::factory()->create($card);
        }

        return $model;
    }

    public function definition()
    {
        return [
            CardGroup::ID => $this->faker->unique()->randomNumber(8),

            CardGroup::USER_ID => $this->faker->unique()->randomNumber(8),

            CardGroup::TYPE => $this->faker->randomElement(CardGroup::TYPE_VALUES),

            CardGroup::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
