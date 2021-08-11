<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Body;
use Database\Factories\ModelFactory;

class BodyFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Body::ID => static::faker()->unique()->randomNumber(8),

            Body::TYPE => static::faker()->randomElement(Body::TYPE_VALUES),
        ];
    }
}
