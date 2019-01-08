<?php

namespace Database\Seeds;

use App\Database\Models\RoleUser;
use App\Database\Models\User;
use App\Database\Models\Role;

class RoleUserTableSeeder extends TableSeeder {

    public function run()
    {
        $userCount  = User::count();
        $normalRole = Role::qWhere(Role::TYPE, Role::TYPE_NORMAL)->first();

        for ( $i = 0; $i < $userCount; $i++)
        {
            $user = User::skip($i)->first();

            RoleUser::create([
                RoleUser::ROLE_ID => $normalRole->getKey(),
                RoleUser::USER_ID => $user->getKey()
            ]);
        }
    }

}
