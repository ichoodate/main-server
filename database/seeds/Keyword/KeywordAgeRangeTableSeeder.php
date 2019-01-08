<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\AgeRange;

class AgeRangeTableSeeder extends TableSeeder {

    const RANGES = [
        [AgeRange::MIN => 20, AgeRange::MAX => 30],
        [AgeRange::MIN => 20, AgeRange::MAX => 40],
        [AgeRange::MIN => 20, AgeRange::MAX => 50],
        [AgeRange::MIN => 30, AgeRange::MAX => 40],
        [AgeRange::MIN => 30, AgeRange::MAX => 50],
        [AgeRange::MIN => 40, AgeRange::MAX => 50]
    ];

    public function run()
    {
        foreach ( static::RANGES as $range )
        {
            AgeRange::create([
                AgeRange::MIN => $range[AgeRange::MIN],
                AgeRange::MAX => $range[AgeRange::MAX]
            ]);
        }
    }

}
