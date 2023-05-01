<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\AgeRange;
use Database\DatabaseSeeder;

class AgeRangeSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($i = 19; $i <= 49; ++$i) {
            for ($j = $i + 1; $j <= 50; ++$j) {
                $model = AgeRange::where([
                    AgeRange::MIN => $i,
                    AgeRange::MAX => $j,
                ])->first();

                if (empty($model)) {
                    AgeRange::factory()->create([
                        AgeRange::MIN => $i,
                        AgeRange::MAX => $j,
                    ]);
                }
            }
        }
    }
}
