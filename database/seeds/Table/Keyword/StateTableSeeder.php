<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Obj;
use App\Models\Keyword\Country;
use App\Models\Keyword\State;
use Database\Seeds\TableSeeder;

class StateTableSeeder extends TableSeeder {

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
