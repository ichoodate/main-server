<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Body;
use Faker\Generator as Faker;

class BodyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Body::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Body::TYPE
                => inst(Faker::class)->randomElement(Body::TYPE_VALUES)
        ];
    }

}
