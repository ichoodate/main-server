<?php

namespace Database\Factories\Model;

use App\Database\Models\Balance;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class BalanceFactory extends ModelFactory {

    public static function default()
    {
        return [
            Balance::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Balance::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Balance::TYPE
                => inst(Faker::class)->randomElement(Balance::TYPE_VALUES),

            Balance::COUNT
                => inst(Faker::class)->unique()->randomNumber(8),

            Balance::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Balance::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
