<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\EduBg;

class EduBgFactory extends ModelFactory {

    public static function default()
    {
        return [
            EduBg::ID
                => static::faker()->unique()->randomNumber(8),

            EduBg::TYPE
                => static::faker()->randomElement(EduBg::TYPE_VALUES)
        ];
    }

}
