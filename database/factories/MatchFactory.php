<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Friend;
use App\Models\Match;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MatchFactory extends Factory
{
    protected $model = Match::class;

    public function createAll($data = [], ?Model $parent = null)
    {
        $attrs = Arr::only($data, array_keys((new static())->definition()));
        $model = $this->create($attrs);
        $data = Arr::add($data, Match::CARDS, []);
        $data = Arr::add($data, Match::FRIENDS, []);

        foreach ($data[Match::CARDS] as $card) {
            $existMatchUserIdVals = array_values(Arr::only($model->getAttributes(), [Match::MAN_ID, Match::WOMAN_ID]));
            $existCardUserIdVals = array_values(Arr::only($card, [Card::CHOOSER_ID, Card::SHOWNER_ID]));
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

            Card::factory()->createAll($card);
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
        ];
    }
}
