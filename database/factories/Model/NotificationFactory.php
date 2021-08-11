<?php

namespace Database\Factories\Model;

use App\Models\Notification;
use Database\Factories\ModelFactory;

class NotificationFactory extends ModelFactory {

    public static function default()
    {
        return [
            Notification::ID
                => static::faker()->unique()->randomNumber(8),

            Notification::USER_ID
                => static::faker()->unique()->randomNumber(8),

            Notification::ACTIVITY_ID
                => static::faker()->unique()->randomNumber(8),

            Notification::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::UPDATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Notification::DELETED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s')
        ];
    }

}
