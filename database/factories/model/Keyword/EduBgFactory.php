<?php

use App\Database\Models\Keyword\EduBg;
use Faker\Generator as Faker;

class EduBgFactory extends ModelFactory {

    public static function default()
    {
        return [
            EduBg::ID
                => inst(Faker::class)->unique()->randomNumber(),

            EduBg::TYPE
                => inst(Faker::class)->randomElement(EduBg::TYPE_VALUES)
        ];
    }

}
