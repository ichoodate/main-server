<?php

namespace Database\Factories\Model;

use App\Models\RelatedKeyword;
use Database\Factories\ModelFactory;

class RelatedKeywordFactory extends ModelFactory
{
    public static function default()
    {
        return [
            RelatedKeyword::ID => static::faker()->unique()->randomNumber(8),

            RelatedKeyword::IDEAL_TYPE_KWD_ID => static::faker()->unique()->randomNumber(8),

            RelatedKeyword::MATCHING_KWD_ID => static::faker()->unique()->randomNumber(8),
        ];
    }
}
