<?php

namespace Database\Factories\Model;

use App\Database\Models\PwdReset;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class PwdResetFactory extends ModelFactory {

    public static function default()
    {
        return [
            PwdReset::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            PwdReset::EMAIL
                => inst(Faker::class)->unique()->randomNumber(8),

            PwdReset::TOKEN
                => inst(Faker::class)->unique()->md5,

            PwdReset::COMPLETE
                => inst(Faker::class)->boolean,

            PwdReset::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            PwdReset::UPDATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }
}
