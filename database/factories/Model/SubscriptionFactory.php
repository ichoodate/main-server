<?php

namespace Database\Factories\Model;

use App\Models\Subscription;
use Database\Factories\ModelFactory;

class SubscriptionFactory extends ModelFactory {

    public static function default()
    {
        return [
            Subscription::ID
                => static::faker()->unique()->randomNumber(8),

            Subscription::USER_ID
                => static::faker()->unique()->randomNumber(8),

            Subscription::PAYMENT_ID
                => static::faker()->unique()->randomNumber(8),

            Subscription::TYPE
                => static::faker()->randomElement(Subscription::TYPE_VALUES),

            Subscription::CREATED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),

            Subscription::DELETED_AT
                => static::faker()->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
