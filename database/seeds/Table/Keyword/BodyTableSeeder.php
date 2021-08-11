<?php

namespace Database\Seeds\Table\Keyword;

use App\Models\Keyword\Body;
use Database\Seeds\TableSeeder;

class BodyTableSeeder extends TableSeeder
{
    public function run()
    {
        foreach (Body::TYPE_VALUES as $type) {
            Body::create([
                Body::TYPE => $type,
            ]);
        }
    }
}
