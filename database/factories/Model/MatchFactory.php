<?php

namespace Database\Factories\Model;

use App\Database\Models\Card;
use App\Database\Models\Friend;
use App\Database\Models\Match;
use App\Database\Models\User;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class MatchFactory extends ModelFactory {

    public static function create(array $data = [])
    {
        $model = parent::create($data);

        $data  = array_add($data, Match::CARDS, []);
        $data  = array_add($data, Match::FRIENDS, []);

        foreach ( $data[Match::CARDS] as $card )
        {
            $existMatchUserIdVals = array_values(array_only($model->getAttributes(), [Match::MAN_ID, Match::WOMAN_ID]));
            $existCardUserIdVals = array_values(array_only($card, [Card::CHOOSER_ID, Card::SHOWNER_ID]));
            $requiredCardUserIdKeys = array_diff([Card::CHOOSER_ID, Card::SHOWNER_ID], array_keys($card));
            $addableMatchUserIdVals = array_diff($existMatchUserIdVals, $existCardUserIdVals);

            shuffle($requiredCardUserIdKeys);
            shuffle($addableMatchUserIdVals);

            foreach ( $addableMatchUserIdVals as $i => $addableMatchUserIdVal )
            {
                $cardUserIdKey        = $requiredCardUserIdKeys[$i];
                $card[$cardUserIdKey] = $addableMatchUserIdVal;
            }

            $card[Card::MATCH] = $model;
            $card[Card::MATCH_ID] = $model->getKey();

            static::factory(Card::class)->create($card);
        }

        foreach ( $data[Match::FRIENDS] as $friend )
        {
            $friend[Card::MATCH_ID] = $model->getKey();

            static::factory(Friend::class)->create($friend);
        }

        return $model;
    }

    public static function default()
    {
        return [
            Match::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Match::MAN_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Match::WOMAN_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Match::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Match::UPDATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
