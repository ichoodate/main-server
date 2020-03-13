<?php

namespace Database\Factories\Model;

use App\Database\Models\Activity;
use Database\Factories\ModelFactory;
use Faker\Generator as Faker;

class ActivityFactory extends ModelFactory {

    public static function default()
    {
        return [
            Activity::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Activity::TYPE
                => inst(Faker::class)->randomElement(Activity::TYPE_VALUES),

            Activity::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Activity::RELATED_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Activity::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
