<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Country;
use App\Models\Keyword\Residence;
use App\Models\Keyword\State;
use Illuminate\Database\Seeder;

class ResidenceSeeder extends Seeder
{
    public function run()
    {
        $count = Country::count();

        for ($i = 0; $i < $count; ++$i) {
            $country = Country::skip($i)->first();

            $model = Residence::where([
                Residence::PARENT_ID => null,
                Residence::RELATED_ID => $country->getKey(),
            ])->first();

            if (empty($model)) {
                Residence::factory()->create([
                    Residence::PARENT_ID => null,
                    Residence::RELATED_ID => $country->getKey(),
                ]);
            }
        }

        $count = State::count();

        for ($i = 0; $i < $count; ++$i) {
            $state = State::skip($i)->first();
            $model = Residence::where([
                Residence::PARENT_ID => $state->country->residence->getKey(),
                Residence::RELATED_ID => $state->getKey(),
            ])->first();

            if (empty($model)) {
                Residence::create([
                    Residence::PARENT_ID => $state->country->residence->getKey(),
                    Residence::RELATED_ID => $state->getKey(),
                ]);
            }
        }
    }
}
