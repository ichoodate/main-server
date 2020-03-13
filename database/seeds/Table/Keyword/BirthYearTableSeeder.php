<?php

namespace Database\Seeds\Table\Keyword;

use App\Database\Models\Keyword\BirthYear;
use Database\Seeds\TableSeeder;

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
