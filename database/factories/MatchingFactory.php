<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Friend;
use App\Models\Matching;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class MatchingFactory extends Factory
{
    protected $model = Matching::class;

    public function createAll($data = [], ?Model $parent = null)
    {
        $attrs = Arr::only($data, (new Matching())->getFillable());
        $model = $this->create($attrs);
        $data = Arr::add($data, Matching::CARDS, []);
        $data = Arr::add($data, Matching::FRIENDS, []);

        foreach ($data[Matching::CARDS] as $card) {
            $existMatchUserIdVals = array_values(Arr::only($model->getAttributes(), [Matching::MAN_ID, Matching::WOMAN_ID]));
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

        foreach ($data[Matching::FRIENDS] as $friend) {
            $friend[Card::MATCH_ID] = $model->getKey();
            Friend::factory()->create($friend);
        }

        return $model;
    }

    public function definition()
    {
        return [
            Matching::MAN_ID => $this->faker->unique()->randomNumber(8),

            Matching::WOMAN_ID => $this->faker->unique()->randomNumber(8),
        ];
    }
}
