<?php

namespace Database\Seeds;

use App\Database\Models\Role;

class RoleTableSeeder extends TableSeeder {

    public function run()
    {
        foreach ( Role::TYPE_VALUES as $type )
        {
            Role::create([Role::TYPE => $type]);
        }
    }

}
