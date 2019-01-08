<?php

namespace Database\Factories\Model;

use App\Database\Models\Notification;
use Faker\Generator as Faker;

class NotificationFactory extends ModelFactory {

    public static function default()
    {
        return [
            Notification::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Notification::ACTIVITY_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Notification::USER_ID
                => inst(Faker::class)->unique()->randomNumber(),

            Notification::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::UPDATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
