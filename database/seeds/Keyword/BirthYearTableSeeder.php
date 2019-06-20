<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Keyword\BirthYear;
use Database\TableSeeder;

class BirthYearTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( range(1970, (new \DateTime)->format('Y')) as $year )
        {
            BirthYear::create([
                BirthYear::TYPE => $year
            ]);
        }
    }

}
