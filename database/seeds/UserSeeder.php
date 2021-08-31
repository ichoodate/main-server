<?php

namespace Database\Seeds;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            User::EMAIL => 'dbwhddn10@gmail.com',
            User::PASSWORD => 'dbwhddn',
        ]);

        for ($i = 1; $i < 100; ++$i) {
            var_dump(static::class, $i);
            User::factory()->create([
                User::EMAIL => 'test'.$i.'@ichoodate.com',
                User::PASSWORD => 'dbwhddn',
            ]);
        }
    }
}
