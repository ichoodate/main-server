<?php

namespace Database\Factories\Model\Keyword;

use App\Models\Keyword\Residence;
use Database\Factories\ModelFactory;

class ResidenceFactory extends ModelFactory
{
    public static function default()
    {
        return [
            Residence::ID => static::faker()->unique()->randomNumber(8),

            Residence::PARENT_ID => static::faker()->unique()->randomNumber(8),

            Residence::RELATED_ID => static::faker()->unique()->randomNumber(8),
        ];
    }
}
