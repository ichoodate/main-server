<?php

namespace Database\Seeds;

use App\Models\Keyword\BirthYear;
use App\Models\Keyword\Career;
use App\Models\Keyword\Drink;
use App\Models\Keyword\Hobby;
use App\Models\Keyword\Nationality;
use App\Models\Keyword\Religion;
use App\Models\Keyword\Residence;
use App\Models\Keyword\Smoke;
use App\Models\Keyword\Stature;
use App\Models\Keyword\Weight;
use App\Models\User;
use App\Models\UserKeyword;
use Database\DatabaseSeeder;
use Illuminate\Support\Arr;

class UserKeywordSeeder extends DatabaseSeeder
{
    public function run()
    {
        $birthYears = BirthYear::get()->all();
        $careers = Career::get()->all();
        $drinks = Drink::get()->all();
        $hobbies = Hobby::get()->all();
        $nationalities = Nationality::get()->all();
        $religions = Religion::get()->all();
        $residences = Residence::get()->all();
        $smokes = Smoke::get()->all();
        $statures = Stature::get()->all();
        $weights = Weight::get()->all();

        for ($userId = 1; $userId <= User::count(); ++$userId) {
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($birthYears)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($careers)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($drinks)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($hobbies)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($nationalities)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($religions)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($residences)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($smokes)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($statures)->id,
            ]));
            $this->add(UserKeyword::factory()->make([
                UserKeyword::USER_ID => $userId,
                UserKeyword::KEYWORD_ID => Arr::random($weights)->id,
            ]));
        }
    }
}
