<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Keyword\Country;
use App\Models\Keyword\Residence;
use App\Models\Keyword\State;
use Database\Seeds\TableSeeder;

class ResidenceTableSeeder extends TableSeeder
{
    public function run()
    {
        $count = Country::count();

        for ($i = 0; $i < $count; ++$i) {
            $country = Country::skip($i)->first();

            Residence::create([
                Residence::PARENT_ID => null,
                Residence::RELATED_ID => $country->getKey(),
            ]);
        }

        $count = State::count();

        for ($i = 0; $i < $count; ++$i) {
            $state = State::skip($i)->first();

            Residence::create([
                Residence::PARENT_ID => $state->country->residence->getKey(),
                Residence::RELATED_ID => $state->getKey(),
            ]);
        }
    }
}
