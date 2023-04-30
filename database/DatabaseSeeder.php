<?php

namespace Database;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        foreach ([
            \Database\Seeds\UserSeeder::class,
            \Database\Seeds\MatchingSeeder::class,
            \Database\Seeds\CardSeeder::class,
            \Database\Seeds\CardFlipSeeder::class,
            \Database\Seeds\FriendSeeder::class,
            \Database\Seeds\ChattingContentSeeder::class,
            \Database\Seeds\FacePhotoSeeder::class,
            \Database\Seeds\ProfilePhotoSeeder::class,
            \Database\Seeds\Keyword\AgeRangeSeeder::class,
            \Database\Seeds\Keyword\BirthYearSeeder::class,
            \Database\Seeds\Keyword\BloodSeeder::class,
            \Database\Seeds\Keyword\BodySeeder::class,
            \Database\Seeds\Keyword\CareerSeeder::class,
            \Database\Seeds\Keyword\CountrySeeder::class,
            \Database\Seeds\Keyword\DrinkSeeder::class,
            \Database\Seeds\Keyword\HobbySeeder::class,
            \Database\Seeds\Keyword\LanguageSeeder::class,
            \Database\Seeds\Keyword\NationalitySeeder::class,
            \Database\Seeds\Keyword\ReligionSeeder::class,
            \Database\Seeds\Keyword\SmokeSeeder::class,
            \Database\Seeds\Keyword\StateSeeder::class,
            \Database\Seeds\Keyword\ResidenceSeeder::class, // after state
            \Database\Seeds\Keyword\StatureRangeSeeder::class,
            \Database\Seeds\Keyword\StatureSeeder::class,
            \Database\Seeds\Keyword\WeightRangeSeeder::class,
            \Database\Seeds\Keyword\WeightSeeder::class,
            \Database\Seeds\UserKeywordSeeder::class,
            \Database\Seeds\IdealTypeKeywordSeeder::class,
        ] as $seederClass) {
            $this->call($seederClass);
        }
    }
}
