<?php

namespace Database\Seeds\Keyword;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Language;
use Database\TableSeeder;

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
