<?php

namespace Database\Seeds;

use App\Database\Models\User;

class UserTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < 1; $i++ )
        {
            User::create([
                "email" => "afeest@hotmail.com",
                "password" => "99/D%:'`y+9`]ou4Zy",
                "birth" => "1980-03-10",
                "gender" => "woman",
                "name" => "Mrs. Elvie Funk DVM",
                "active" => true,
                "coin" => 76041,
                "remember_token" => "3f22968bc195b6631ba35715e6237864001cb76b2b7cf2fb055e419b18435038",
                "created_at" => "2018-01-24 03:50:06"
            ]);
            // User::create(array_except(
            //     $this->factory(User::class)->make()->getAttributes(),
            //     [User::ID]
            // ));
        }
    }

}
