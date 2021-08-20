<?php

namespace Database\Factories\Model;

use App\Models\IdealTypeKeyword;
use Database\Factories\ModelFactory;

class IdealTypeKeywordFactory extends ModelFactory
{
    public static function default()
    {
        return [
            IdealTypeKeyword::ID => static::faker()->unique()->randomNumber(8),

            IdealTypeKeyword::USER_ID => static::faker()->unique()->randomNumber(8),

            IdealTypeKeyword::KEYWORD_ID => static::faker()->unique()->randomNumber(8),
        ];
    }
}
