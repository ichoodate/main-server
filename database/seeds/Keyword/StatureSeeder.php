<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Stature;
use Illuminate\Database\Seeder;

class StatureSeeder extends Seeder
{
    public function run()
    {
        foreach (range(140, 200) as $cm) {
            $model = Stature::where([
                Stature::CM => $cm,
                Stature::INCH => (int) ($cm * 0.393701),
            ])->first();

            if (empty($model)) {
                $stature = Stature::create([
                    Stature::CM => $cm,
                    Stature::INCH => (int) ($cm * 0.393701),
                ]);
            }
        }
    }
}
