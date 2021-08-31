<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        foreach ([
            \Database\Seeds\UserSeeder::class,
            \Database\Seeds\MatchSeeder::class,
            \Database\Seeds\CardSeeder::class,
            \Database\Seeds\CardFlipSeeder::class,
            \Database\Seeds\FriendSeeder::class,
            \Database\Seeds\ChattingContentSeeder::class,
            \Database\Seeds\FacePhotoSeeder::class,
            \Database\Seeds\ProfilePhotoSeeder::class,
            // \Database\Seeds\Keyword\AgeRangeSeeder::class,
            // \Database\Seeds\Keyword\BirthYearSeeder::class,
            // \Database\Seeds\Keyword\BloodSeeder::class,
            // \Database\Seeds\Keyword\BodySeeder::class,
            // \Database\Seeds\Keyword\CareerSeeder::class,
            // \Database\Seeds\Keyword\CountrySeeder::class,
            // \Database\Seeds\Keyword\DrinkSeeder::class,
            // \Database\Seeds\Keyword\HobbySeeder::class,
            // \Database\Seeds\Keyword\LanguageSeeder::class,
            // \Database\Seeds\Keyword\NationalitySeeder::class,
            // \Database\Seeds\Keyword\ReligionSeeder::class,
            // \Database\Seeds\Keyword\ResidenceSeeder::class,
            // \Database\Seeds\Keyword\SmokeSeeder::class,
            // \Database\Seeds\Keyword\StateSeeder::class,
            // \Database\Seeds\Keyword\StatureRangeSeeder::class,
            // \Database\Seeds\Keyword\StatureSeeder::class,
            // \Database\Seeds\Keyword\WeightRangeSeeder::class,
            // \Database\Seeds\Keyword\WeightSeeder::class,
            // \Database\Seeds\UserKeywordSeeder::class,
            // \Database\Seeds\IdealTypeKeywordSeeder::class,
        ] as $seederClass) {
            $this->call($seederClass);
        }
        // $this->call(FacePhotoSeeder::class);
        // $this->call(ProfilePhotoSeeder::class);
        // $this->call(MatchSeeder::class);
        // $this->call(CardSeeder::class);
        // $this->call(CardFlipSeeder::class);
        // $this->call(ChattingContentSeeder::class);
        // $this->call(AgeRangeSeeder::class);
        // $this->call(BirthYearSeeder::class);
        // $this->call(BloodSeeder::class);
        // $this->call(BodySeeder::class);
        // $this->call(CareerSeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(DrinkSeeder::class);
        // $this->call(HobbySeeder::class);
        // $this->call(LanguageSeeder::class);
        // $this->call(NationalitySeeder::class);
        // $this->call(ReligionSeeder::class);
        // $this->call(SmokeSeeder::class);
        // $this->call(StateSeeder::class);
        // $this->call(StatureSeeder::class);
        // $this->call(StatureRangeSeeder::class);
        // $this->call(WeightSeeder::class);
        // $this->call(WeightRangeSeeder::class);
        // $this->call(ResidenceSeeder::class);
        // $this->call(IdealTypeKeywordSeeder::class);
        // $this->call(UserKeywordSeeder::class);
    }
}
