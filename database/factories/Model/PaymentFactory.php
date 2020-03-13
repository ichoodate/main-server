<?php

namespace Database\Factories\Model;

use App\Database\Models\Payment;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class PaymentFactory extends ModelFactory {

    public static function default()
    {
        return [
            Payment::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Payment::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Payment::ITEM_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Payment::AMOUNT
                => inst(Faker::class)->randomNumber(),

            Payment::CURRENCY
                => inst(Faker::class)->currencyCode,

            Payment::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

        ];
    }

}
