<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\BirthYear;
use Illuminate\Database\Seeder;

class BirthYearSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1970, (new \DateTime())->format('Y')) as $year) {
            BirthYear::create([
                BirthYear::TYPE => $year,
            ]);
        }
    }
}
