<?php

namespace Database\Seeds\Table;

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
use Database\Seeds\TableSeeder;

class UserKeywordTableSeeder extends TableSeeder
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

            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $birthYear->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $career->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $drink->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $hobby->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $nationality->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $religion->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $residence->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $smoke->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $stature->getKey(),
            ]);
            $this->factory(UserKeyword::class)->create([
                UserKeyword::USER_ID => $user->getKey(),
                UserKeyword::KEYWORD_ID => $weight->getKey(),
            ]);
        }
    }
}
