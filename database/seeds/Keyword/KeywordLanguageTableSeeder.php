<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Language;

class LanguageTableSeeder extends TableSeeder {

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
