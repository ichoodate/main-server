<?php

namespace Database\Factories\Model;

use App\Database\Models\Payment;
use Database\Factories\ModelFactory;

class PaymentFactory extends ModelFactory {

    public static function default()
    {
        return [
            Payment::ID
                => static::faker()->unique()->randomNumber(8),

            Payment::USER_ID
                => static::faker()->unique()->randomNumber(8),

            Payment::ITEM_ID
                => static::faker()->unique()->randomNumber(8),

            Payment::AMOUNT
                => static::faker()->randomNumber(),

            Payment::CURRENCY
                => static::faker()->currencyCode,

            Payment::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

        ];
    }

}
