<?php

namespace Database\Seeds\Table;

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
use App\Models\UserIdealTypeKwdPvt;
use Database\Seeds\TableSeeder;

class UserIdealTypeKwdPvtTableSeeder extends TableSeeder
{
    public function run()
    {
        for ($i = 0; $i < User::count(); ++$i) {
            $user = User::skip($i)->first();
            $ageRange = AgeRange::orderByRaw('rand()')->first();
            $career = Career::orderByRaw('rand()')->first();
            $drink = Drink::orderByRaw('rand()')->first();
            $hobby = Hobby::orderByRaw('rand()')->first();
            $nationality = Nationality::orderByRaw('rand()')->first();
            $religion = Religion::orderByRaw('rand()')->first();
            $residence = Residence::orderByRaw('rand()')->first();
            $smoke = Smoke::orderByRaw('rand()')->first();
            $statureRange = StatureRange::orderByRaw('rand()')->first();
            $weightRange = WeightRange::orderByRaw('rand()')->first();

            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $ageRange->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $career->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $drink->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $hobby->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $nationality->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $religion->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $residence->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $smoke->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $statureRange->getKey(),
            ]);
            $this->factory(UserIdealTypeKwdPvt::class)->create([
                UserIdealTypeKwdPvt::USER_ID => $user->getKey(),
                UserIdealTypeKwdPvt::KEYWORD_ID => $weightRange->getKey(),
            ]);
        }
    }
}
