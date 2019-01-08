<?php

namespace Database\Factories\Model\Keyword;

use App\Database\Models\Keyword\Body;
use Faker\Generator as Faker;

class BodyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Body::ID
                => inst(Faker::class)->unique()->randomNumber(),

            Body::TYPE
                => inst(Faker::class)->randomElement(Body::TYPE_VALUES)
        ];
    }

}
