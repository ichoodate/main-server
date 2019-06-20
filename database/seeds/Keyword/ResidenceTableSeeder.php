<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\State;
use App\Database\Models\Keyword\Residence;
use Database\TableSeeder;

class ResidenceTableSeeder extends TableSeeder {

    public function run()
    {
        $count = Country::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $country = Country::skip($i)->first();

            Residence::create([
                Residence::PARENT_ID => null,
                Residence::RELATED_ID => $country->getKey()
            ]);
        }

        $count = State::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $state = State::skip($i)->first();

            Residence::create([
                Residence::PARENT_ID => $state->CountryQuery()->residenceQuery()->first()->getKey(),
                Residence::RELATED_ID => $state->getKey()
            ]);
        }
    }

}
