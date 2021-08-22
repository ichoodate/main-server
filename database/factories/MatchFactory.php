<?php

namespace Database\Factories;

use App\Models\Match;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class MatchFactory extends Factory
{
    protected $model = Match::class;

    public function create($data = [], ?Model $parent = null)
    {
        if (empty($data)) {
            return parent::create($data, $parent);
        }

        $attrs = array_only($data, array_keys((new static())->definition()));
        $model = $this->state($attrs)->create();
        $data = array_add($data, Match::CARDS, []);
        $data = array_add($data, Match::FRIENDS, []);

        foreach ($data[Match::CARDS] as $card) {
            $existMatchUserIdVals = array_values(array_only($model->getAttributes(), [Match::MAN_ID, Match::WOMAN_ID]));
            $existCardUserIdVals = array_values(array_only($card, [Card::CHOOSER_ID, Card::SHOWNER_ID]));
            $requiredCardUserIdKeys = array_diff([Card::CHOOSER_ID, Card::SHOWNER_ID], array_keys($card));
            $addableMatchUserIdVals = array_diff($existMatchUserIdVals, $existCardUserIdVals);

            shuffle($requiredCardUserIdKeys);
            shuffle($addableMatchUserIdVals);

            foreach ($addableMatchUserIdVals as $i => $addableMatchUserIdVal) {
                $cardUserIdKey = $requiredCardUserIdKeys[$i];
                $card[$cardUserIdKey] = $addableMatchUserIdVal;
            }

            $card[Card::MATCH] = $model;
            $card[Card::MATCH_ID] = $model->getKey();

            Card::factory()->create($card);
        }

        foreach ($data[Match::FRIENDS] as $friend) {
            $friend[Card::MATCH_ID] = $model->getKey();
            Friend::factory()->create($friend);
        }

        return $model;
    }

    public function definition()
    {
        return [
            Match::ID => $this->faker->unique()->randomNumber(8),

            Match::MAN_ID => $this->faker->unique()->randomNumber(8),

            Match::WOMAN_ID => $this->faker->unique()->randomNumber(8),

            Match::CREATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),

            Match::UPDATED_AT => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
