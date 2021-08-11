<?php

namespace Database\Factories\Model;

use App\Models\Card;
use App\Models\CardGroup;
use Database\Factories\ModelFactory;

class CardGroupFactory extends ModelFactory
{
    public static function create(array $data = [])
    {
        $data = array_add($data, CardGroup::CARDS, []);
        $model = parent::create($data);

        foreach ($data[CardGroup::CARDS] as $card) {
            $card[Card::GROUP_ID] = $data[CardGroup::ID];
            $card[Card::CHOOSER_ID] = $data[CardGroup::USER_ID];

            static::factory(Card::class)->create($card);
        }

        return $model;
    }

    public static function default()
    {
        return [
            CardGroup::ID => static::faker()->unique()->randomNumber(8),

            CardGroup::USER_ID => static::faker()->unique()->randomNumber(8),

            CardGroup::TYPE => static::faker()->randomElement(CardGroup::TYPE_VALUES),

            CardGroup::CREATED_AT => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
