<?php

namespace Database\Seeds\Table;

use App\Models\User;
use App\Models\ProfilePhoto;
use Database\Seeds\TableSeeder;

class ProfilePhotoTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $k = 0; $k < 100; $k++ )
        {
            for ( $i = 0; $i < 10; $i++ )
            {
                $user  = User::skip($i)->first();
                $width = rand(100, 1920);
                $height = rand(100, 1080);

                $data = 'data:image/jpg;base64,'.base64_encode(file_get_contents('https://picsum.photos/'.$width.'/'.$height));

                ProfilePhoto::create([
                    'user_id' => $user->getKey(),
                    'data'    => $data
                ]);
            }
        }
    }

}
