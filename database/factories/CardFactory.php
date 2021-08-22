<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function create($data = [], ?Model $parent = null)
    {
        if (empty($data)) {
            return parent::create($data, $parent);
        }

        $attrs = array_only($data, array_keys((new static())->definition()));
        $model = $this->state($attrs)->create();
        $data = array_add($data, Card::FLIPS, []);

        foreach ($data[Card::FLIPS] as $flip) {
            if (!array_key_exists(CardFlip::USER_ID, $flip)) {
                $addableUserIds = array_values(array_only($data, [
                    Card::CHOOSER_ID, Card::SHOWNER_ID,
                ]));

                shuffle($addableUserIds);

                $flip[CardFlip::USER_ID] = $addableUserIds[0];
            }

            $flip[CardFlip::CARD_ID] = $model->getKey();

            CardFlip::factory()->create($flip);
        }

        return $model;
    }

    public function definition()
    {
        return [
            Card::ID => $this->faker->unique()->randomNumber(8),

            Card::GROUP_ID => $this->faker->unique()->randomNumber(8),

            Card::MATCH_ID => $this->faker->unique()->randomNumber(8),

            Card::CHOOSER_ID => $this->faker->unique()->randomNumber(8),

            Card::SHOWNER_ID => $this->faker->unique()->randomNumber(8),

            Card::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Card::UPDATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
