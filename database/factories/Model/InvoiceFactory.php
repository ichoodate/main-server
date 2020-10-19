<?php

namespace Database\Factories\Model;

use App\Database\Models\Invoice;
use Database\Factories\ModelFactory;

class InvoiceFactory extends ModelFactory {

    public static function default()
    {
        return [
            Invoice::ID
                => static::faker()->unique()->randomNumber(8),

            Invoice::USER_ID
                => static::faker()->unique()->randomNumber(8),

            Invoice::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
