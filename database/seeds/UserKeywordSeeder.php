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
use Illuminate\Database\Seeder;

class UserKeywordSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < User::count(); ++$i) {
            $user = User::skip($i)->first();
            $birthYear = BirthYear::orderByRaw('rand()')->first();
            $career = Career::orderByRaw('rand()')->first();
            $drink = Drink::orderByRaw('rand()')->first();
            $hobby = Hobby::orderByRaw('rand()')->first();
            $nationality = Nationality::orderByRaw('rand()')->first();
            $religion = Religion::orderByRaw('rand()')->first();
            $residence = Residence::orderByRaw('rand()')->first();
            $smoke = Smoke::orderByRaw('rand()')->first();
            $stature = Stature::orderByRaw('rand()')->first();
            $weight = Weight::orderByRaw('rand()')->first();

            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $birthYear->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $career->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $drink->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $hobby->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $nationality->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $religion->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $residence->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $smoke->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $stature->getKey(),
            ]);
            UserKeyword::factory()->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $weight->getKey(),
            ]);
        }
    }
}
