<?php

namespace Database\Factories\Model;

use App\Models\UserKeyword;
use Database\Factories\ModelFactory;

class UserKeywordFactory extends ModelFactory
{
    public static function default()
    {
        return [
            UserKeyword::ID => static::faker()->unique()->randomNumber(8),

            UserKeyword::USER_ID => static::faker()->unique()->randomNumber(8),

            UserKeyword::KEYWORD_ID => static::faker()->unique()->randomNumber(8),
        ];
    }
}
