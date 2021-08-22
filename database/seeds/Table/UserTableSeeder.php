<?php

namespace Database\Seeds\Table;

use App\Models\User;
use Database\Seeds\TableSeeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends TableSeeder
{
    public function run()
    {
        for ($i = 0; $i < 1000; ++$i) {
            if (0 == $i) {
                User::factory()->create([
                    User::EMAIL => 'dbwhddn10@gmail.com',
                    User::PASSWORD => Hash::make('dbwhddn'),
                ]);
            } else {
                User::factory()->create([
                    User::PASSWORD => Hash::make('dbwhddn'),
                ]);
            }
        }
    }
}
