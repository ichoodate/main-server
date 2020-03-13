<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\Stature;
use Faker\Generator as Faker;

class StatureFactory extends ModelFactory {

    public static function default()
    {
        $cm = inst(Faker::class)->numberBetween(140, 200);

        return [
            Stature::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Stature::CM
                => $cm,

            Stature::INCH
                => (int)($cm * 0.393701),
        ];
    }

}
