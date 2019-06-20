<?php

namespace Database\Factories\Models;

use App\Database\Models\Subscription;
use Faker\Generator as Faker;

class SubscriptionFactory extends ModelFactory {

    public static function default()
    {
        return [
            Subscription::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Subscription::USER_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Subscription::PAYMENT_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Subscription::TYPE
                => inst(Faker::class)->randomElement(Subscription::TYPE_VALUES),

            Subscription::CREATED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),

            Subscription::DELETED_AT
                => inst(Faker::class)->dateTimeThisYear->format('Y-m-d H:i:s'),
        ];
    }

}
