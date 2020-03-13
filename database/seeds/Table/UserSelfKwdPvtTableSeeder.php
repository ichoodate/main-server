<?php

namespace Database\Seeds\Table;

use App\Database\Models\User;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\Keyword\BirthYear;
use App\Database\Models\Keyword\Career;
use App\Database\Models\Keyword\Drink;
use App\Database\Models\Keyword\Hobby;
use App\Database\Models\Keyword\Nationality;
use App\Database\Models\Keyword\Religion;
use App\Database\Models\Keyword\Residence;
use App\Database\Models\Keyword\Smoke;
use App\Database\Models\Keyword\Stature;
use App\Database\Models\Keyword\Weight;
use Database\Seeds\TableSeeder;

class UserSelfKwdPvtTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < User::count(); $i++)
        {
            $user             = User::skip($i)->first();
            $birthYear        = BirthYear::orderByRaw('rand()')->first();
            $career           = Career::orderByRaw('rand()')->first();
            $drink            = Drink::orderByRaw('rand()')->first();
            $hobby            = Hobby::orderByRaw('rand()')->first();
            $nationality      = Nationality::orderByRaw('rand()')->first();
            $religion         = Religion::orderByRaw('rand()')->first();
            $residence        = Residence::orderByRaw('rand()')->first();
            $smoke            = Smoke::orderByRaw('rand()')->first();
            $stature          = Stature::orderByRaw('rand()')->first();
            $weight           = Weight::orderByRaw('rand()')->first();

            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $birthYear->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $career->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $drink->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $hobby->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $nationality->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $religion->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $residence->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $smoke->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $stature->getKey()
            ]);
            $this->factory(UserSelfKwdPvt::class)->create([
                UserSelfKwdPvt::USER_ID => $user->getKey(),
                UserSelfKwdPvt::KEYWORD_ID => $weight->getKey()
            ]);
        }
    }

}
