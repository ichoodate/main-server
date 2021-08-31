<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Smoke;
use Illuminate\Database\Seeder;

class SmokeSeeder extends Seeder
{
    public function run()
    {
        foreach (Smoke::TYPE_VALUES as $type) {
            $model = Smoke::where([
                Smoke::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Smoke::factory()->create([
                    Smoke::TYPE => $type,
                ]);
            }
        }
    }
}
