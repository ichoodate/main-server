<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Country;
use App\Models\Keyword\Nationality;
use Database\DatabaseSeeder;

class NationalitySeeder extends DatabaseSeeder
{
    public function run()
    {
        $count = Country::count();

        for ($i = 0; $i < $count; ++$i) {
            $country = Country::skip($i)->first();
            $model = Nationality::where([
                Nationality::COUNTRY_ID => $country->getKey(),
            ])->first();

            if (empty($model)) {
                Nationality::factory()->create([
                    Nationality::COUNTRY_ID => $country->getKey(),
                ]);
            }
        }
    }
}
