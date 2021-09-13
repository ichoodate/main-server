<?php

namespace Database\Seeds;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            User::ID => 1,
            User::GENDER => User::GENDER_MAN,
            User::EMAIL => 'dbwhddn10@gmail.com',
            User::PASSWORD => 'dbwhddn',
        ]);

        for ($i = 1; $i < 1000; ++$i) {
            var_dump(static::class, $i);
            User::factory()->create([
                User::EMAIL => 'test'.$i.'@ichoodate.com',
                User::PASSWORD => 'dbwhddn',
            ]);
        }
    }
}
