<?php

namespace Database\Factories\Model;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class CardGroupFactory extends ModelFactory {

    public static function create(array $data = [])
    {
        $data  = array_add($data, CardGroup::CARDS, []);
        $model = parent::create($data);

        foreach ( $data[CardGroup::CARDS] as $card )
        {
            $card[Card::GROUP_ID] = $data[CardGroup::ID];
            $card[Card::CHOOSER_ID] = $data[CardGroup::USER_ID];

            static::factory(Card::class)->create($card);
        }

        return $model;
    }

    public static function default()
    {
        return [
            CardGroup::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            CardGroup::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            CardGroup::TYPE
                => inst(Faker::class)->randomElement(CardGroup::TYPE_VALUES),

            CardGroup::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
