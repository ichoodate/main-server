<?php

namespace Database\Factories\Models;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\Obj;
use App\Database\Models\Match;
use Faker\Generator as Faker;

class CardFactory extends ModelFactory {

    public static function create(array $data = [])
    {
        $data  = array_add($data, Card::ACTIVITIES, []);
        $model = parent::create($data);

        foreach ( $data[Card::ACTIVITIES] as $activity )
        {
            if ( array_key_exists(Activity::TYPE, $activity) && $activity[Activity::TYPE] == Activity::TYPE_CARD_PROPOSE )
            {
                $searched = array_where($data[Card::ACTIVITIES], function ($values) use ($activity) {

                    return $values[Activity::TYPE] == Activity::TYPE_CARD_OPEN && $values[Activity::USER_ID] == $activity[Activity::USER_ID];
                });

                if ( empty($searched) )
                {
                    $activity[Activity::TYPE] = Activity::TYPE_CARD_OPEN;

                    array_push($data[Card::ACTIVITIES], $activity);
                }
            }
        }

        foreach ( $data[Card::ACTIVITIES] as $activity )
        {
            if ( array_key_exists(Activity::TYPE, $activity) && $activity[Activity::TYPE] == Activity::TYPE_CARD_OPEN )
            {
                $searched = array_where($data[Card::ACTIVITIES], function ($values) use ($activity) {

                    return $values[Activity::TYPE] == Activity::TYPE_CARD_FLIP && $values[Activity::USER_ID] == $activity[Activity::USER_ID];
                });

                if ( empty($searched) )
                {
                    $activity[Activity::TYPE] = Activity::TYPE_CARD_FLIP;

                    array_push($data[Card::ACTIVITIES], $activity);
                }
            }
        }

        foreach ( $data[Card::ACTIVITIES] as $activity  )
        {
            if ( ! array_key_exists(Activity::USER_ID, $activity) )
            {
                $addableUserIds = array_values(array_only($data, [
                    Card::CHOOSER_ID, Card::SHOWNER_ID
                ]));

                shuffle($addableUserIds);

                $activity[Activity::USER_ID] = $addableUserIds[0];
            }

            $activity[Activity::RELATED_ID] = $model->getKey();

            static::factory(Activity::class)->create($activity);
        }

        return $model;
    }

    public static function default()
    {
        return [
            Card::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Card::GROUP_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Card::MATCH_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Card::CHOOSER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Card::SHOWNER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Card::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Card::UPDATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
