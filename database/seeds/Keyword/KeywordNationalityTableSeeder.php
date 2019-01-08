<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;

class NationalityTableSeeder extends TableSeeder {

    public function run()
    {
        $count = Country::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $keywordCountry = Country::skip($i)->first();

            Nationality::create([
                Nationality::COUNTRY_ID => $keywordCountry->getKey()
            ]);
        }
    }
}
