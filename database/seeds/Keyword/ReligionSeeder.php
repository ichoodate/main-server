<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    public function run()
    {
        foreach (Religion::TYPE_VALUES as $type) {
            $model = Religion::where([
                Religion::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Religion::factory()->create([
                    Religion::TYPE => $type,
                ]);
            }
        }
    }
}
