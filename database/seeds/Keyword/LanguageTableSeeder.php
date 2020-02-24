<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder {

    public function run()
    {
        foreach ( Language::TYPE_VALUES as $type )
        {
            Language::create([
                Language::TYPE => $type
            ]);
        }
    }

}
