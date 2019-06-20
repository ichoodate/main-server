<?php

namespace Database\Seeds;

use App\Database\Models\User;
use Database\TableSeeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < 10; $i++ )
        {
            if ( $i == 0 )
            {
                $this->factory(User::class)->create([
                    User::EMAIL => 'dbwhddn10@gmail.com',
                    User::PASSWORD => Hash::make('dbwhddn')
                ]);
            }
            else
            {
                $this->factory(User::class)->create([
                    User::PASSWORD => Hash::make('dbwhddn')
                ]);
            }
        }
    }

}
