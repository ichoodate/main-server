<?php

use Illuminate\Database\Seeder;
use Database\Seeds\ActivityTableSeeder;
use Database\Seeds\CardTableSeeder;
use Database\Seeds\ChattingContentTableSeeder;
use Database\Seeds\MatchTableSeeder;
use Database\Seeds\UserTableSeeder;
use Database\Seeds\UserIdealTypeKwdPvtTableSeeder;
use Database\Seeds\UserSelfKwdPvtTableSeeder;
use Database\Seeds\Keyword\AgeRangeTableSeeder;
use Database\Seeds\Keyword\BirthYearTableSeeder;
use Database\Seeds\Keyword\BloodTableSeeder;
use Database\Seeds\Keyword\BodyTableSeeder;
use Database\Seeds\Keyword\CareerTableSeeder;
use Database\Seeds\Keyword\CountryTableSeeder;
use Database\Seeds\Keyword\DrinkTableSeeder;
use Database\Seeds\Keyword\HobbyTableSeeder;
use Database\Seeds\Keyword\LanguageTableSeeder;
use Database\Seeds\Keyword\NationalityTableSeeder;
use Database\Seeds\Keyword\ReligionTableSeeder;
use Database\Seeds\Keyword\ResidenceTableSeeder;
use Database\Seeds\Keyword\SmokeTableSeeder;
use Database\Seeds\Keyword\StateTableSeeder;
use Database\Seeds\Keyword\StatureTableSeeder;
use Database\Seeds\Keyword\StatureRangeTableSeeder;
use Database\Seeds\Keyword\WeightTableSeeder;
use Database\Seeds\Keyword\WeightRangeTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(MatchTableSeeder::class);
        $this->call(CardTableSeeder::class);
        $this->call(ActivityTableSeeder::class);
        $this->call(ChattingContentTableSeeder::class);
        $this->call(AgeRangeTableSeeder::class);
        $this->call(BirthYearTableSeeder::class);
        $this->call(BloodTableSeeder::class);
        $this->call(BodyTableSeeder::class);
        $this->call(CareerTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(DrinkTableSeeder::class);
        $this->call(HobbyTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(NationalityTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(SmokeTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(StatureTableSeeder::class);
        $this->call(StatureRangeTableSeeder::class);
        $this->call(WeightTableSeeder::class);
        $this->call(WeightRangeTableSeeder::class);
        $this->call(ResidenceTableSeeder::class);
        $this->call(UserIdealTypeKwdPvtTableSeeder::class);
        $this->call(UserSelfKwdPvtTableSeeder::class);
    }

}
