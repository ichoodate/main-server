<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\BirthYear;
use Database\DatabaseSeeder;

class BirthYearSeeder extends DatabaseSeeder
{
    public function run()
    {
        foreach (range(1970, (new \DateTime())->format('Y')) as $year) {
            $model = BirthYear::where([
                BirthYear::TYPE => $year,
            ])->first();

            if (empty($model)) {
                BirthYear::factory()->create([
                    BirthYear::TYPE => $year,
                ]);
            }
        }
    }
}
