<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Body;

class BodyFactory extends ModelFactory {

    public static function default()
    {
        return [
            Body::ID
                => static::faker()->unique()->randomNumber(8),

            Body::TYPE
                => static::faker()->randomElement(Body::TYPE_VALUES)
        ];
    }

}
