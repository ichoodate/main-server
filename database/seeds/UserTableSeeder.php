<?php

namespace Database\Seeds;

use App\Database\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {

    public function run()
    {
        for ( $i = 0; $i < 1000; $i++ )
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
