<?php

namespace Database\Factories\Model\Keyword;

use Database\Factories\ModelFactory;
use App\Database\Models\Keyword\BirthYear;
use Faker\Generator as Faker;

class BirthYearFactory extends ModelFactory {

    public static function default()
    {
        return [
            BirthYear::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            BirthYear::YEAR
                => inst(Faker::class)->numberBetween(1950, (new \DateTime)->format('Y'))
        ];
    }

}