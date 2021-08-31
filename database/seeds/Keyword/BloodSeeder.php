<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Blood;
use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    public function run()
    {
        foreach (Blood::TYPE_VALUES as $type) {
            $model = Blood::where([
                Blood::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Blood::factory()->create([
                    Blood::TYPE => $type,
                ]);
            }
        }
    }
}
