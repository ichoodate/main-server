<?php

namespace Database\Seeds;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\AgeRange;
use App\Models\Keyword\Career;
use App\Models\Keyword\Drink;
use App\Models\Keyword\Hobby;
use App\Models\Keyword\Nationality;
use App\Models\Keyword\Religion;
use App\Models\Keyword\Residence;
use App\Models\Keyword\Smoke;
use App\Models\Keyword\StatureRange;
use App\Models\Keyword\WeightRange;
use App\Models\User;
use Database\DatabaseSeeder;
use Illuminate\Support\Arr;

class IdealTypeKeywordSeeder extends DatabaseSeeder
{
    public function run()
    {
        $ageRanges = AgeRange::get()->all();
        $careers = Career::get()->all();
        $drinks = Drink::get()->all();
        $hobbies = Hobby::get()->all();
        $nationalities = Nationality::get()->all();
        $religions = Religion::get()->all();
        $residences = Residence::get()->all();
        $smokes = Smoke::get()->all();
        $statureRanges = StatureRange::get()->all();
        $weightRanges = WeightRange::get()->all();

        for ($userId = 1; $userId <= User::count(); ++$userId) {
            var_dump(static::class, $userId);
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($ageRanges)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($careers)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($drinks)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($hobbies)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($nationalities)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($religions)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($residences)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($smokes)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($statureRanges)->id,
            ]));
            $this->add(IdealTypeKeyword::factory()->make([
                IdealTypeKeyword::USER_ID => $userId,
                IdealTypeKeyword::KEYWORD_ID => Arr::random($weightRanges)->id,
            ]));
        }
    }
}
