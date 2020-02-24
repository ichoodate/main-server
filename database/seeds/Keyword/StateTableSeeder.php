<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder {

    public function run()
    {
        $count = Country::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $country = Country::skip($i)->first();

            foreach ( range(1, 10) as $j )
            {
                State::create([
                    State::NAME => $country->{Country::ISO}.'_state_'.$j,
                    State::COUNTRY_ID => $country->getKey()
                ]);
            }
        }
    }

}
