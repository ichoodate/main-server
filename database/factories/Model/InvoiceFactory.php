<?php

namespace Database\Factories\Model;

use App\Database\Models\Invoice;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class InvoiceFactory extends ModelFactory {

    public static function default()
    {
        return [
            Invoice::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Invoice::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Invoice::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
