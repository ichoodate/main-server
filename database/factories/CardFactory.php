<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\CardFlip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function createAll($data = [], ?Model $parent = null)
    {
        $attrs = Arr::only($data, array_keys((new static())->definition()));
        $model = parent::create($attrs, $parent);
        $data = Arr::add($data, Card::FLIPS, []);

        foreach ($data[Card::FLIPS] as $flip) {
            if (!array_key_exists(CardFlip::USER_ID, $flip)) {
                $addableUserIds = array_values(Arr::only($data, [
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
