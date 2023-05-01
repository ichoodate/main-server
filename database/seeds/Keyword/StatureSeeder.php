<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Stature;
use Database\DatabaseSeeder;

class StatureSeeder extends DatabaseSeeder
{
    public function run()
    {
        foreach (range(140, 200) as $cm) {
            $model = Stature::where([
                Stature::CM => $cm,
                Stature::INCH => (int) ($cm * 0.393701),
            ])->first();

            if (empty($model)) {
                $stature = Stature::factory()->create([
                    Stature::CM => $cm,
                    Stature::INCH => (int) ($cm * 0.393701),
                ]);
            }
        }
    }
}
