<?php

namespace Database\Seeds\Keyword;

use App\Models\Keyword\Body;
use Illuminate\Database\Seeder;

class BodySeeder extends Seeder
{
    public function run()
    {
        foreach (Body::TYPE_VALUES as $type) {
            $model = Body::where([
                Body::TYPE => $type,
            ])->first();

            if (empty($model)) {
                Body::factory()->create([
                    Body::TYPE => $type,
                ]);
            }
        }
    }
}
