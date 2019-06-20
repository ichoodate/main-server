<?php

namespace Database\Factories\Models;

use App\Database\Models\Notification;
use Faker\Generator as Faker;

class NotificationFactory extends ModelFactory {

    public static function default()
    {
        return [
            Notification::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Notification::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Notification::ACTIVITY_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Notification::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::UPDATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
