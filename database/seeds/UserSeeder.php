<?php

namespace Database\Seeds;

use App\Models\User;
use Database\DatabaseSeeder;

class UserSeeder extends DatabaseSeeder
{
    public function run()
    {
        User::factory()->create([
            User::GENDER => User::GENDER_MAN,
            User::EMAIL => 'dbwhddn10@gmail.com',
            User::PASSWORD => 'dbwhddn',
        ]);

        for ($i = 1; $i < 1000; ++$i) {
            var_dump(static::class, $i);
            $this->add(User::factory()->make([
                User::EMAIL => 'test'.$i.'@ichoodate.com',
                User::PASSWORD => 'test1234',
            ]));
        }
        $this->flush();
    }
}
