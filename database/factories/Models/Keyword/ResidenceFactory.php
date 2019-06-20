<?php

namespace Database\Factories\Models\Keyword;

use Database\Factories\Models\ModelFactory;
use App\Database\Models\Keyword\Residence;
use Faker\Generator as Faker;

class ResidenceFactory extends ModelFactory {

    public static function default()
    {
        return [
            Residence::ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Residence::PARENT_ID
                => inst(Faker::class)->unique()->randomNumber(8),

            Residence::RELATED_ID
                => inst(Faker::class)->unique()->randomNumber(8)
        ];
    }

}
