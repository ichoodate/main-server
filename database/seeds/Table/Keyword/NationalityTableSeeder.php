<?php

namespace Database\Seeds\Table\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Country;
use App\Database\Models\Keyword\Nationality;
use Database\Seeds\TableSeeder;

class NationalityTableSeeder extends TableSeeder {

    public function run()
    {
        $count = Country::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $country = Country::skip($i)->first();

            Nationality::create([
                Nationality::COUNTRY_ID => $country->getKey()
            ]);
        }
    }

}
