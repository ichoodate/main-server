<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\Character;

class CharacterTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Character::TYPE_VALUES as $type )
        {
            Character::create([
                Character::TYPE => $type
            ]);
        }
    }
}
