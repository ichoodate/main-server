<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\EduBg;
use Faker\Generator as Faker;

class EduBgFactory extends ModelFactory {

    public static function default()
    {
        return [
            EduBg::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            EduBg::TYPE
                => inst(Faker::class)->randomElement(EduBg::TYPE_VALUES)
        ];
    }

}
